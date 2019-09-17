<?php

namespace app\modules\auth\rbac\rules;

use app\modules\auth\interfaces\StatusControl;
use yii\rbac\Rule;

class StatusRule extends Rule
{
    public $name = 'status';

    /**
     * {@inheritDoc}
     */
    public function execute($user, $item, $params): bool
    {
        if ($params['model'] instanceof StatusControl) {
            return \Yii::$app->user->can($params['model']->getOrganizationType()->role);
        }
        return false;
    }
}