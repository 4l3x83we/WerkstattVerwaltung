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
    'import',
    fn (Generator $trail) => $trail->parent('dashboard')->push('import', route('admin.imports.index'))
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

Breadcrumbs::for(
    'customers',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Kunden', route('backend.kunden.index'))
);

Breadcrumbs::for(
    'customersCreate',
    fn (Generator $trail) => $trail->parent('customers')->push('Neuen Kunden anlegen', route('backend.kunden.create'))
);

Breadcrumbs::for(
    'customersEdit',
    fn (Generator $trail, $value) => $trail->parent('customers')->push('Bearbeite: '.$value->fullname(), route('backend.kunden.edit', $value->id))
);

Breadcrumbs::for(
    'customersShow',
    fn (Generator $trail, $value) => $trail->parent('customers')->push($value->fullname(), route('backend.kunden.show', $value->id))
);

Breadcrumbs::for(
    'vehicles',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Fahrzeuge', route('backend.fahrzeuge.index'))
);

Breadcrumbs::for(
    'vehiclesCreate',
    fn (Generator $trail) => $trail->parent('vehicles')->push('Neues Fahrzeuge anlegen', route('backend.fahrzeuge.create'))
);

Breadcrumbs::for(
    'vehiclesEdit',
    fn (Generator $trail, $value) => $trail->parent('vehicles')->push('Bearbeite: '.$value->vehicles_license_plate, route('backend.fahrzeuge.edit', $value->id))
);

Breadcrumbs::for(
    'vehiclesShow',
    fn (Generator $trail, $value) => $trail->parent('vehicles')->push($value->vehicles_license_plate, route('backend.fahrzeuge.show', $value->id))
);

Breadcrumbs::for(
    'product',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Produkt', route('backend.produkte.index'))
);

Breadcrumbs::for(
    'productCreate',
    fn (Generator $trail) => $trail->parent('product')->push('Neues Produkt anlegen', route('backend.produkte.create'))
);

Breadcrumbs::for(
    'productEdit',
    fn (Generator $trail, $value) => $trail->parent('product')->push('Bearbeite: '.$value->product_name, route('backend.produkte.edit', $value->id))
);

Breadcrumbs::for(
    'productShow',
    fn (Generator $trail, $value) => $trail->parent('product')->push($value->product_name, route('backend.produkte.show', $value->id))
);

Breadcrumbs::for(
    'category',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Kategorie', route('backend.kategorie.index'))
);

Breadcrumbs::for(
    'categoryCreate',
    fn (Generator $trail) => $trail->parent('category')->push('Neues Kategorie anlegen', route('backend.kategorie.create'))
);

Breadcrumbs::for(
    'categoryEdit',
    fn (Generator $trail, $value) => $trail->parent('category')->push('Bearbeite: '.$value->category_title, route('backend.kategorie.edit', $value->id))
);

Breadcrumbs::for(
    'categoryShow',
    fn (Generator $trail, $value) => $trail->parent('category')->push($value->category_title, route('backend.kategorie.show', $value->id))
);

Breadcrumbs::for(
    'invoice',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Rechnungen', route('backend.rechnung.index'))
);

Breadcrumbs::for(
    'invoiceCreate',
    fn (Generator $trail) => $trail->parent('invoice')->push('Neue Rechnung erstellen', route('backend.rechnung.create'))
);

Breadcrumbs::for(
    'invoiceEdit',
    fn (Generator $trail, $value) => $trail->parent('invoice')->push('Bearbeite Rechnung: '.$value->invoice_nr, route('backend.rechnung.edit', $value->id))
);

Breadcrumbs::for(
    'invoiceShow',
    fn (Generator $trail, $value) => $trail->parent('invoice')->push($value->invoice_name, route('backend.rechnung.show', $value->id))
);

Breadcrumbs::for(
    'offer',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Angebote', route('backend.angebote.index'))
);

Breadcrumbs::for(
    'offerCreate',
    fn (Generator $trail) => $trail->parent('offer')->push('Neues Angebot erstellen', route('backend.angebote.create'))
);

Breadcrumbs::for(
    'offerEdit',
    fn (Generator $trail, $value) => $trail->parent('offer')->push('Bearbeite Angebot: '.$value->offer_nr, route('backend.angebote.edit', $value->id))
);

Breadcrumbs::for(
    'offerShow',
    fn (Generator $trail, $value) => $trail->parent('offer')->push($value->offer_name, route('backend.angebote.show', $value->id))
);

Breadcrumbs::for(
    'order',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Auftrage', route('backend.auftraege.index'))
);

Breadcrumbs::for(
    'orderCreate',
    fn (Generator $trail) => $trail->parent('order')->push('Neuen Auftrag erstellen', route('backend.auftraege.create'))
);

Breadcrumbs::for(
    'orderEdit',
    fn (Generator $trail, $value) => $trail->parent('order')->push('Bearbeite Auftrag: '.$value->order_nr, route('backend.auftraege.edit', $value->id))
);

Breadcrumbs::for(
    'orderShow',
    fn (Generator $trail, $value) => $trail->parent('order')->push($value->order_name, route('backend.auftraege.show', $value->id))
);
