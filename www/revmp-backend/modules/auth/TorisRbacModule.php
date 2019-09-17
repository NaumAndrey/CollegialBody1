<?php

namespace app\modules\auth;

use yii\base\Module;

/**
 * Created by PhpStorm.
 * User: nikita.klesov
 * Date: 15.03.2018
 * Time: 17:03
 */
class TorisRbacModule extends Module
{
    /** {@inheritdoc} */
    public $controllerNamespace = 'app\modules\auth\controllers';

    /** @var string Роль Администратора системы */
    public $roleAdmin;

    /** @var string Роль Наблюдателя */
    public $roleObserver;

    /** @var string Роль Сотрудника комитета по культуре */
    public $roleCulture;

    /** @var string Роль Сотрудника театра */
    public $roleTheater;

    /** @var string Роль Сотрудника библиотеки */
    public $roleLibrary;

    /** @var string Роль Сотрудника кинопрокатных программ */
    public $roleCinema;

    /** @var string Роль Сотрудника культурно-досугового учреждения */
    public $roleLeisure;

    /** @var string Роль Сотрудника музея */
    public $roleMuseum;

    /** @var string Роль Сотрудника образовательного учреждения */
    public $roleEducation;

    /** @var string Роль Сотрудника парка */
    public $rolePark;

    /** @var string Роль Сотрудника объединенного межведомственного архива культуры */
    public $roleInterdepartmental;

    /** @var string Роль Сотрудника института культурных программ */
    public $roleInstitute;
}