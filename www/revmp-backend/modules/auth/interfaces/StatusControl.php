<?php

namespace app\modules\auth\interfaces;

interface StatusControl
{
    public static function getStatusList(): array;

    public function getStatusWay(): array;
}