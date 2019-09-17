<?php

namespace app\modules\auth\controllers;

use app\modules\auth\models\TorisUser;
use app\modules\auth\services\AuthService;
use app\modules\auth\TorisRbacModule;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\UnauthorizedHttpException;

/**
 * Access controller for the `toris` module
 */
class AccessController extends Controller
{
    /** @var AuthService */
    protected $authService;

    public function __construct($id, TorisRbacModule $module, array $config = [])
    {
        $this->authService = \Yii::$app->torisAuthService;
        parent::__construct($id, $module, $config);
    }

    /**
     * @return bool
     * @throws BadRequestHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionIndex($aistoken): bool
    {
        if ($aistoken && $this->authService->updateUser($this->authService->run($aistoken))) {
            return true;
        }
        throw new BadRequestHttpException('Нет доступа к системе', 401);
    }

    /**
     * @return array
     * @throws UnauthorizedHttpException
     * @throws \yii\base\Exception
     * @throws \Throwable
     */
    public function actionInfo(): array
    {
        $aistoken = \Yii::$app->request->getHeaders()->get('Authorization');

        if ($aistoken !== null && preg_match('/^Bearer\s+(.*?)$/', $aistoken, $matches)) {
            $aistoken = $matches[1];
            $identity = TorisUser::findIdentityByAccessToken($aistoken, 'yii\filters\auth\HttpBearerAuth');

            if ($identity === null) {
                $user['fio'] = $this->authService->run($aistoken)['data']['USER_FIO'];
                $user['token'] = $aistoken;
                $user['roles'] = ['guest'];
            } else {
                $user = $identity->toArray();
                $user['roles'] = \array_keys(\Yii::$app->authManager->getRolesByUser($identity['id']));
            }

            return $user;
        }
        throw new UnauthorizedHttpException;
    }
}
