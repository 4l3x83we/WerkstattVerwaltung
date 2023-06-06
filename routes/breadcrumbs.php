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
    fn (Generator $trail) => $trail->parent('dashboard')->push('Einstellungen', route('admin.einstellungen.index'))
);

/*Breadcrumbs::for(
    'product',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Produkt', route('backend.products.index'))
);

Breadcrumbs::for(
    'productCreate',
    fn (Generator $trail) => $trail->parent('product')->push('Neues Produkt anlegen', route('backend.products.create'))
);

Breadcrumbs::for(
    'productEdit',
    fn (Generator $trail, $value) => $trail->parent('product')->push('Bearbeite: '.$value->product_name, route('backend.products.edit', $value->id))
);

Breadcrumbs::for(
    'productShow',
    fn (Generator $trail, $value) => $trail->parent('product')->push($value->product_name, route('backend.products.show', $value->id))
);

Breadcrumbs::for(
    'invoice',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Rechnungen', route('backend.invoices.index'))
);

Breadcrumbs::for(
    'invoiceCreate',
    fn (Generator $trail) => $trail->parent('invoice')->push('Neue Rechnung erstellen', route('backend.invoices.create'))
);

Breadcrumbs::for(
    'invoiceEdit',
    fn (Generator $trail, $value) => $trail->parent('invoice')->push('Bearbeite Rechnung: #'.$value->id, route('backend.invoices.edit', $value->id))
);

Breadcrumbs::for(
    'invoiceShow',
    fn (Generator $trail, $value) => $trail->parent('invoice')->push($value->invoice_name, route('backend.invoices.show', $value->id))
);*/
