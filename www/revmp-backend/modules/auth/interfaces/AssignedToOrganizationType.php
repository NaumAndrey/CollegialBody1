<?php

namespace app\modules\auth\interfaces;

use app\models\OrganizationType;

interface AssignedToOrganizationType
{
    public function getOrganizationType(): OrganizationType;
}