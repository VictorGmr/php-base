<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Modules\Core\Helpers\Application\ModuleConfig;
use Modules\Example\Entities;

Breadcrumbs::for('pessoa-list', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push(ModuleConfig::getLabel('plural'), route('pessoa-list'));
});

Breadcrumbs::for('pessoa-create', function (BreadcrumbTrail $trail) {
    $trail->parent('pessoa-list');
    $trail->push("Cadastrar ".ModuleConfig::getLabel(), route('pessoa-create'));
});

Breadcrumbs::for('pessoa-edit', function (BreadcrumbTrail $trail, Entities\Pessoa $pessoa) {
    $trail->parent('pessoa-list');
    $trail->push("Editar ".ModuleConfig::getLabel(), route('pessoa-edit',$pessoa->uuid));
});
