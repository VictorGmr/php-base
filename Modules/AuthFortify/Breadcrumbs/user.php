<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\AuthFortify\Entities;
/**
 * Application
 */

Breadcrumbs::for('user-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(ModuleConfig::getLabel('plural'), route('user-list'));
});

Breadcrumbs::for('user-create', function (BreadcrumbTrail $trail) {
    $trail->parent('user-list');
    $trail->push(ModuleConfig::getPageTitle().' '.ModuleConfig::getLabel(), route('user-create'));
});

Breadcrumbs::for('user-profile', function (BreadcrumbTrail $trail, Entities\User $user) {
    $trail->parent('user-list');
    $trail->push(ModuleConfig::getPageTitle().' '.ModuleConfig::getLabel(), route('user-profile',$user->uuid));
});

Breadcrumbs::for('user-config', function (BreadcrumbTrail $trail, Entities\User $user) {
    $trail->parent('user-list');
    $trail->push(ModuleConfig::getPageTitle().' '.ModuleConfig::getLabel(), route('user-config',$user->uuid));
});
