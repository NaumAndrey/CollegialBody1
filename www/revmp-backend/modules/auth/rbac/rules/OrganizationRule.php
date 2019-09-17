<?php

namespace app\modules\auth\rbac\rules;

use app\modules\auth\interfaces\AssignedToOrganizationType;
use yii\rbac\Rule;

class OrganizationRule extends Rule
{
    public $name = 'org.type.equal';

    /**
     * {@inheritDoc}
     */
    public function execute($user, $item, $params): bool
    {
        if ($params['model'] instanceof AssignedToOrganizationType) {
            return \Yii::$app->user->can($params['model']->getOrganizationType()->role);
        }
        return false;
    }
}