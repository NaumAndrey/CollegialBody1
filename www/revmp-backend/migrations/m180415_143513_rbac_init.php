<?php
/**
 * Created by PhpStorm.
 * User: futul
 * Date: 24.07.18
 * Time: 14:56
 */

use app\modules\auth\rbac\rules\OrganizationRule;
use yii\db\Migration;
use yii\rbac\Role;

/**
 * Class m180415_143513_rbac_init
 */
class m180415_143513_rbac_init extends Migration
{
    protected const MODELS = [
        'order' => [
            'formation',
            'registered',
            'archive',
            'deleted',
        ],
        'organization' => [
            'draft',
            'consideration',
            'clarification',
            'registered',
            'archive',
            'deleted',
        ],
        'evmp' => [
            'draft',
            'included.refinement',
            'excluded.refinement',
            'included.agreement',
            'excluded.agreement',
            'included',
            'excluded',
            'included.archive',
            'excluded.archive',
            'deleted',
        ],
        'scroll' => [
            'draft',
            'consideration',
            'clarification',
            'approved',
            'archive',
            'deleted',
        ],
    ];

    protected const ACTIONS = ['view', 'edit', 'status'];

    protected const ROLES = [
        'admin',
        'observer',
        'culture',
        'theater',
        'library',
        'cinema',
        'leisure',
        'museum',
        'education',
        'park',
        'interdepartmental',
        'institute',
        'operator',
    ];

    /**
     * {@inheritdoc}
     * @throws Exception
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        foreach (self::ROLES as $role) {
            $$role = $auth->createRole($role);
            $auth->add($$role);
        }
        /**
         * @var Role $admin
         * @var Role $observer
         * @var Role $culture
         * @var Role $operator
         */

        $organizationRule = new OrganizationRule();

        $auth->add($organizationRule);
        foreach (self::ACTIONS as $action) {
            foreach (self::MODELS as $model => $statuses) {
                foreach ($statuses as $status) {
                    $name = $action . ucfirst($model) . ucfirst($status);
                    $$name = $auth->createPermission("$action.$model.$status");
                    $auth->add($$name);
                    $org = 'org' . ucfirst($name);
                    $$org = $auth->createPermission("org.$action.$model.$status");
                    $$org->ruleName = $organizationRule->name;
                    $auth->add($$org);
                    if ($action === 'view' && $status !== 'deleted') {
                        $auth->addChild($observer, $$name);
                        $auth->addChild($$org, $$name);
                        $auth->addChild($operator, $$org);
                    } elseif ($action !== 'edit') {
                        $auth->addChild($admin, $$name);
                    }
                }
            }
        }

        $operatorCanEditStatus = [
            'order' => [
                'formation',
            ],
            'organization' => [
                'draft',
                'consideration',
            ],
            'evmp' => [
                'draft',
                'included.refinement',
                'excluded.refinement',
            ],
            'scroll' => [
                'draft',
                'consideration',
            ],
        ];

        foreach ($operatorCanEditStatus as $model => $statuses) {
            foreach ($statuses as $status) {
                $name = 'orgEdit' . ucfirst($model) . ucfirst($status);
                $auth->addChild($operator, $$name);
                $name = 'orgStatus' . ucfirst($model) . ucfirst($status);
                $auth->addChild($operator, $$name);
            }
        }

        $observerCan = [
            'order' => [
                'formation' => ['edit', 'status'],
                'registered' => ['status'],
            ],
            'organization' => [
                'draft' => ['edit', 'status'],
                'consideration' => ['edit', 'status'],
                'clarification' => ['edit', 'status'],
                'registered' => ['status'],
            ],
            'evmp' => [
                'draft' => ['edit', 'status'],
                'included.refinement' => ['edit', 'status'],
                'excluded.refinement' => ['edit', 'status'],
                'included.agreement' => ['edit', 'status'],
                'excluded.agreement' => ['edit', 'status'],
                'included.archive' => ['status'],
                'excluded.archive' => ['status'],
            ],
            'scroll' => [
                'draft' => ['edit', 'status'],
                'consideration' => ['edit', 'status'],
                'clarification' => ['edit', 'status'],
                'approved' => ['status'],
            ],
        ];

        foreach ($observerCan as $model => $statuses) {
            foreach ($statuses as $status => $actions) {
                foreach ($actions as $action) {
                    $name = $action . ucfirst($model) . ucfirst($status);
                    $auth->addChild($observer, $$name);
                }
            }
        }

        /**
         * @var Role $theater
         * @var Role $library
         * @var Role $cinema
         * @var Role $leisure
         * @var Role $museum
         * @var Role $education
         * @var Role $park
         * @var Role $interdepartmental
         * @var Role $institute
         */
        $auth->addChild($theater, $operator);
        $auth->addChild($library, $operator);
        $auth->addChild($cinema, $operator);
        $auth->addChild($leisure, $operator);
        $auth->addChild($museum, $operator);
        $auth->addChild($education, $operator);
        $auth->addChild($park, $operator);
        $auth->addChild($interdepartmental, $operator);
        $auth->addChild($institute, $operator);

        $auth->addChild($culture, $theater);
        $auth->addChild($culture, $library);
        $auth->addChild($culture, $cinema);
        $auth->addChild($culture, $leisure);
        $auth->addChild($culture, $museum);
        $auth->addChild($culture, $education);
        $auth->addChild($culture, $park);
        $auth->addChild($culture, $interdepartmental);
        $auth->addChild($culture, $institute);

        $auth->addChild($admin, $culture);
        $auth->addChild($admin, $observer);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }
}