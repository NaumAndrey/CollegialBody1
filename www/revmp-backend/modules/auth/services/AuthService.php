<?php

namespace app\modules\auth\services;

use app\modules\auth\helpers\TorisAuthApi;
use app\modules\auth\models\AuthAssignment;
use app\modules\auth\models\TorisUser;
use app\modules\auth\TorisRbacModule;
use Yii;
use yii\base\BaseObject;

/**
 * Created by PhpStorm.
 * User: a.lukyanovich
 * Date: 16.05.2018
 * Time: 10:46
 */
class AuthService extends BaseObject
{
    public $domain;
    public $code;
    public $urn;

    protected $rolesArray = [];
    protected $rolesShortNames = [];

    public function init(): void
    {
        parent::init();
        /** @var TorisRbacModule $module */
        $module = Yii::$app->getModule('auth');
        $this->rolesArray[$module->roleAdmin] = 'Администратор системы';
        $this->rolesShortNames[$module->roleAdmin] = 'admin';
        $this->rolesArray[$module->roleObserver] = 'Наблюдатель';
        $this->rolesShortNames[$module->roleObserver] = 'observer';
        $this->rolesArray[$module->roleCulture] = 'Сотрудник комитета по культуре';
        $this->rolesShortNames[$module->roleCulture] = 'culture';
        $this->rolesArray[$module->roleTheater] = 'Сотрудник театра';
        $this->rolesShortNames[$module->roleTheater] = 'theater';
        $this->rolesArray[$module->roleLibrary] = 'Сотрудник библиотеки';
        $this->rolesShortNames[$module->roleLibrary] = 'library';
        $this->rolesArray[$module->roleCinema] = 'Сотрудника кинопрокатных программ';
        $this->rolesShortNames[$module->roleCinema] = 'cinema';
        $this->rolesArray[$module->roleLeisure] = 'Сотрудник культурно-досугового учреждения';
        $this->rolesShortNames[$module->roleLeisure] = 'leisure';
        $this->rolesArray[$module->roleMuseum] = 'Сотрудник музея';
        $this->rolesShortNames[$module->roleMuseum] = 'museum';
        $this->rolesArray[$module->roleEducation] = 'Сотрудник образовательного учреждения';
        $this->rolesShortNames[$module->roleEducation] = 'education';
        $this->rolesArray[$module->rolePark] = 'Сотрудник парка';
        $this->rolesShortNames[$module->rolePark] = 'park';
        $this->rolesArray[$module->roleInterdepartmental] = 'Сотрудник объединенного межведомственного архива культуры';
        $this->rolesShortNames[$module->roleInterdepartmental] = 'interdepartmental';
        $this->rolesArray[$module->roleInstitute] = 'Сотрудника института культурных программ';
        $this->rolesShortNames[$module->roleInstitute] = 'institute';
    }

    /**
     * @param $aistoken
     * @return array
     * @throws \yii\base\Exception
     */
    public function run($aistoken): array
    {
        $api = new TorisAuthApi([
            'baseUrl' => Yii::$app->params['torisSettings']['full_domain'] . $this->urn,
            'aistoken' => $aistoken,
            'systemId' => $this->code,
        ]);
        return $api->send();
    }

    /**
     * @param array $result
     * @return bool
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function updateUser(array $result): bool
    {
        if (!$result['data']['USER_ROLES']) {
            return false;
        }

        $user = TorisUser::findIdentityByEsovUID($result['data']['USER_ESOV_UID']);

        //освежаем токен существующего юзера, а если такого юзера нет, создаем со всеми пришедшими аттрибутами
        if ($user) {
            $user->aistoken = $result['data']['AISTOKEN'];
            $user->is_http = \array_key_exists('HTTP_X_FORWARDED_PROTO', $_SERVER) ? $_SERVER['HTTP_X_FORWARDED_PROTO'] !== 'https' : true;
            $user->updated_at = \date('Y-m-d H:i:s');
            $user->save();
        } else {
            $user = TorisUser::createNewUser($result['data']);
        }
        /** @var array $sended_roles */
        $sended_roles = $result['data']['USER_ROLES'];

        $new_roles = [];

        foreach ($sended_roles as $role) {
            if (\array_key_exists($role, $this->rolesShortNames)) {
                $new_roles[] = $this->rolesShortNames[$role];
            }
        }

        if (empty($new_roles)) {
            return false;
        }

        $auth = \Yii::$app->authManager;
        $old_roles = AuthAssignment::find()->where(['user_id' => $user->id])->indexBy('item_name')->all();

        if ($old_roles) {
            foreach ($old_roles as $old_role) {
                if (!\in_array($old_role->item_name, $new_roles, true)) {
                    $old_role->delete();
                }
            }

            foreach ($new_roles as $new_role) {
                if (!\array_key_exists($new_role, $old_roles)) {
                    $auth->assign($auth->getRole($new_role), $user->id);
                }
            }
        } else {
            foreach ($new_roles as $new_role) {
                $auth->assign($auth->getRole($new_role), $user->id);
            }
        }

        return true;
    }
}