<?php

use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
use Rawilk\Breadcrumbs\Support\Generator;

Breadcrumbs::for('dashboard', fn (Generator $trail) => $trail->push('Dashboard', route('dashboard')));

Breadcrumbs::for(
    'register',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Register', route('register.2'))
);

Breadcrumbs::for(
    'benutzer',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Benutzer', route('admin.users.index'))
);

Breadcrumbs::for(
    'benutzerCreate',
    fn (Generator $trail) => $trail->parent('benutzer')->push('Neuen Benutzer anlegen', route('admin.users.create'))
);

Breadcrumbs::for(
    'benutzerShow',
    fn (Generator $trail, $value) => $trail->parent('benutzer')->push($value->name, route('admin.users.show', $value->id))
);

Breadcrumbs::for(
    'rollen',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Rollen', route('admin.roles.index'))
);

Breadcrumbs::for(
    'rollenCreate',
    fn (Generator $trail) => $trail->parent('rollen')->push('Neuen Rollen anlegen', route('admin.roles.create'))
);

Breadcrumbs::for(
    'rollenEdit',
    fn (Generator $trail, $value) => $trail->parent('rollen')->push('Bearbeite: '.$value->name, route('admin.roles.edit', $value->id))
);

Breadcrumbs::for(
    'rollenShow',
    fn (Generator $trail, $value) => $trail->parent('rollen')->push($value->name, route('admin.roles.show', $value->id))
);

Breadcrumbs::for(
    'permission',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Berechtigungen', route('admin.permission.index'))
);

Breadcrumbs::for(
    'permissionCreate',
    fn (Generator $trail) => $trail->parent('permission')->push('Neuen Berechtigungen anlegen', route('admin.permission.create'))
);

Breadcrumbs::for(
    'permissionEdit',
    fn (Generator $trail, $value) => $trail->parent('permission')->push('Bearbeite: '.$value->name, route('admin.permission.edit', $value->id))
);

Breadcrumbs::for(
    'settings',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Einstellungen', route('admin.settings.index'))
);
