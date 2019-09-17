<?php

namespace app\modules\auth\models;

use app\modules\auth\services\AuthService;
use Exception;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "toris_user".
 *
 * @property int $id
 * @property int $ebosp_id
 * @property string $esov_uid
 * @property string $fio
 * @property string $aistoken
 * @property bool $is_http
 * @property string $email
 * @property int $updated_at
 *
 * @property Ebosp $ebosp
 */
class TorisUser extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'toris_user';
    }

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public static function createNewUser(array $data): TorisUser
    {
        $user = new self();
        $user->setAttributes([
            'fio' => $data['USER_FIO'],
            'aistoken' => $data['AISTOKEN'],
            'esov_uid' => $data['USER_ESOV_UID'],
            'email' => $data['USER_EMAIL'],
        ]);
        $transaction = self::getDb()->beginTransaction();
        try {
            if (($data['ORG_CODE_IOGV'] !== '0100000017' || empty($modelEbosp = Ebosp::findOne(['short_name' => $data['DEP_NAME']])))
                && empty($modelEbosp = Ebosp::findOne(['code' => $data['ORG_CODE_IOGV']]))) {
                /** @noinspection CurlSslServerSpoofingInspection */
                $options = [
                    CURLOPT_CONNECTTIMEOUT => 30,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_FOLLOWLOCATION => false,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HEADER => true,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_TIMEOUT => 5000,
                    CURLOPT_HEADERFUNCTION => static function ($resource, $headerString) use (&$responseHeader) {
                        $header = \trim($headerString, "\r\n");
                        if ($header !== '') {
                            $responseHeader[] = $header;
                        }
                        return \mb_strlen($headerString, '8bit');
                    },
                ];

                $curl = \curl_init(\str_replace('{EBOSP_ID}', $data['ORG_CODE_IOGV'], \Yii::$app->params['get-ebosp-web']));
                \curl_setopt_array($curl, $options);
                $response = \curl_exec($curl);
                $errorNumber = \curl_errno($curl);
                $errorMessage = \curl_error($curl);
                \curl_close($curl);

                if ($errorNumber > 0) {
                    throw new \Exception('Curl error: #' . $errorNumber . ' - ' . $errorMessage);
                }
                foreach ($responseHeader as $name => $value) {
                    $response = \str_replace($value, '', $response);
                }

                $ebosp = \json_decode(\substr($response, \strspn($response, "\r\n")), true);
                $modelEbosp = new Ebosp();
                $modelEbosp->code = $data['ORG_CODE_IOGV'];
                $modelEbosp->ebosp_name = $ebosp['iogvName'] ?? null;
                $modelEbosp->short_name = $ebosp['iogvSname'] ?? $modelEbosp->ebosp_name;
                if (!$modelEbosp->save()) {
                    $transaction->rollBack();
                }
            }
            $user->is_http = \array_key_exists('HTTP_X_FORWARDED_PROTO', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https' : true;
            $user->ebosp_id = $modelEbosp->id;
            $user->save();
            $transaction->commit();
            return $user;
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @inheritdoc
     * @return TorisUser|null
     */
    public static function findIdentityByEsovUID($uid): ?TorisUser
    {
        return static::find()->where('esov_uid = :uid', [':uid' => $uid])->one();
    }

    /**
     * @inheritdoc
     * @return TorisUser|null
     */
    public static function findIdentity($id): ?TorisUser
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public static function findIdentityByAccessToken($token, $type = null): ?IdentityInterface
    {
        if ($type !== 'yii\filters\auth\HttpBearerAuth') {
            return null;
        }
        $query = static::find()
            ->where(['aistoken' => $token])
            ->andWhere('"toris_user"."updated_at" > NOW() - interval \'10 minute\'')
            ->limit(1);
        if (($identity = $query->one()) !== null) {
            return $identity;
        }
        /** @var AuthService $authService */
        $authService = \Yii::$app->torisAuthService;
        $authService->updateUser($authService->run($token));
        return $query->one();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ebosp_id', 'aistoken'], 'required'],
            [['ebosp_id'], 'default', 'value' => null],
            [['ebosp_id'], 'integer'],
            [['aistoken', 'email'], 'string'],
            [['is_http'], 'boolean'],
            [['esov_uid', 'fio'], 'string', 'max' => 255],
            [['ebosp_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ebosp::class, 'targetAttribute' => ['ebosp_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ebosp_id' => 'ИОГВ',
            'esov_uid' => 'ЕСОВ ID',
            'fio' => 'ФИО',
            'aistoken' => 'aistoken',
            'email' => 'E-mail',
        ];
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     *
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEbosp()
    {
        return $this->hasOne(Ebosp::class, ['id' => 'ebosp_id']);
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        // TODO: Implement getAuthKey() method.
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        // TODO: Implement validateAuthKey() method.
    }
}
