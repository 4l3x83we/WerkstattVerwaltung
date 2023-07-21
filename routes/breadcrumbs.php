<?php

use Rawilk\Breadcrumbs\Facades\Breadcrumbs;
use Rawilk\Breadcrumbs\Support\Generator;

Breadcrumbs::for(
    'dashboard',
    fn (Generator $trail) => $trail->push('Dashboard', route('dashboard'))
);

Breadcrumbs::for(
    'backend',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Backend', route('dashboard'))
);

Breadcrumbs::for(
    'admin',
    fn (Generator $trail) => $trail->parent('dashboard')->push('Admin', route('dashboard'))
);

Breadcrumbs::for(
    'register',
    fn (Generator $trail) => $trail->parent('admin')->push('Register', route('register.2'))
);

Breadcrumbs::for(
    'benutzer',
    fn (Generator $trail) => $trail->parent('admin')->push('Benutzer', route('admin.users.index'))
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
    fn (Generator $trail) => $trail->parent('admin')->push('Rollen', route('admin.roles.index'))
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
    fn (Generator $trail) => $trail->parent('admin')->push('import', route('admin.imports.index'))
);

Breadcrumbs::for(
    'permission',
    fn (Generator $trail) => $trail->parent('admin')->push('Berechtigungen', route('admin.permission.index'))
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
    fn (Generator $trail) => $trail->parent('admin')->push('Einstellungen', route('admin.einstellungen.index'))
);

Breadcrumbs::for(
    'customers',
    fn (Generator $trail) => $trail->parent('backend')->push('Kunden', route('backend.kunden.index'))
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
    'historyShow',
    fn (Generator $trail, $value) => $trail->parent('customersShow', $value->customer)->push('Historie', route('backend.history.index', $value->customer_id))
);

Breadcrumbs::for(
    'vehicles',
    fn (Generator $trail) => $trail->parent('backend')->push('Fahrzeuge', route('backend.fahrzeuge.index'))
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
    fn (Generator $trail) => $trail->parent('backend')->push('Produkt', route('backend.produkte.index'))
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
    fn (Generator $trail) => $trail->parent('backend')->push('Kategorie', route('backend.kategorie.index'))
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
    'inv',
    fn (Generator $trail) => $trail->parent('backend')->push('Rechnungen', route('backend.invoice.offen.index'))
);

Breadcrumbs::for(
    'invoice',
    fn (Generator $trail) => $trail->parent('inv')->push('Offen', route('backend.invoice.offen.index'))
);

Breadcrumbs::for(
    'invoiceCreate',
    fn (Generator $trail) => $trail->parent('invoice')->push('Neue Rechnung erstellen', route('backend.invoice.offen.create'))
);

Breadcrumbs::for(
    'invoiceEdit',
    fn (Generator $trail, $value) => $trail->parent('invoice')->push('Bearbeite Rechnung: '.$value->invoice_nr, route('backend.invoice.offen.edit', $value->id))
);

Breadcrumbs::for(
    'invoiceShow',
    fn (Generator $trail, $value) => $trail->parent('invoice')->push('Rechnung '.$value->invoice_nr, route('backend.invoice.offen.show', $value->id))
);

Breadcrumbs::for(
    'offer',
    fn (Generator $trail) => $trail->parent('backend')->push('Angebote', route('backend.angebote.index'))
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
    fn (Generator $trail) => $trail->parent('backend')->push('Aufträge', route('backend.auftraege.index'))
);

Breadcrumbs::for(
    'orderCreate',
    fn (Generator $trail) => $trail->parent('order')->push('Neuen Auftrag erstellen', route('backend.auftraege.create'))
);

Breadcrumbs::for(
    'orderEdit',
    fn (Generator $trail, $value) => $trail->parent('order')->push('Bearbeite Aufträge: '.$value->order_nr, route('backend.auftraege.edit', $value->order_nr))
);

Breadcrumbs::for(
    'draft',
    fn (Generator $trail) => $trail->parent('inv')->push('Entwurf', route('backend.invoice.entwurf.index'))
);

Breadcrumbs::for(
    'draftEdit',
    fn (Generator $trail, $value) => $trail->parent('draft')->push('Bearbeite Rechnungsentwurf: '.$value->invoice_nr, route('backend.invoice.entwurf.edit', $value->id))
);

Breadcrumbs::for(
    'invoicePaid',
    fn (Generator $trail) => $trail->parent('inv')->push('Bezahlt', route('backend.invoice.bezahlt.index'))
);

Breadcrumbs::for(
    'invoicePaidShow',
    fn (Generator $trail, $value) => $trail->parent('invoicePaid')->push('Rechnung '.$value->invoice_nr, route('backend.invoice.bezahlt.show', $value->id))
);

Breadcrumbs::for(
    'invoiceCredit',
    fn (Generator $trail) => $trail->parent('inv')->push('Storno/Gutschrift', route('backend.invoice.storno.index'))
);

Breadcrumbs::for(
    'invoiceCreditShow',
    fn (Generator $trail, $value) => $trail->parent('invoiceCredit')->push('Stornorechnung '.$value->invoice_nr, route('backend.invoice.storno.show', $value->id))
);

Breadcrumbs::for(
    'invoiceAll',
    fn (Generator $trail) => $trail->parent('inv')->push('Alle', route('backend.invoice.alle.index'))
);

Breadcrumbs::for(
    'invoiceAllShow',
    fn (Generator $trail, $value) => $trail->parent('invoiceAll')->push('Rechnung '.$value->invoice_nr, route('backend.invoice.alle.show', $value->id))
);

Breadcrumbs::for(
    'report',
    fn (Generator $trail) => $trail->parent('backend')->push('Berichte', route('backend.berichte.invoice.index'))
);

Breadcrumbs::for(
    'invoiceReport',
    fn (Generator $trail) => $trail->parent('report')->push('Rechnung', route('backend.berichte.invoice.index'))
);

Breadcrumbs::for(
    'revenue',
    fn (Generator $trail) => $trail->parent('report')->push('Einnahmen', route('backend.berichte.revenue.index'))
);

Breadcrumbs::for(
    'salesVolume',
    fn (Generator $trail) => $trail->parent('report')->push('Umsatz', route('backend.berichte.sales-volume.index'))
);

Breadcrumbs::for(
    'cashBook',
    fn (Generator $trail) => $trail->parent('report')->push('Kassenbuch', route('backend.berichte.cash-book.index'))
);

Breadcrumbs::for(
    'cardPayment',
    fn (Generator $trail) => $trail->parent('report')->push('Kartenzahlung', route('backend.berichte.card-payment.index'))
);

Breadcrumbs::for(
    'cashRegister',
    fn (Generator $trail) => $trail->parent('report')->push('Registerkasse', route('backend.berichte.cash-register.index'))
);

Breadcrumbs::for(
    'positions',
    fn (Generator $trail) => $trail->parent('report')->push('Positionen', route('backend.berichte.positions.index'))
);

Breadcrumbs::for(
    'emails',
    fn (Generator $trail) => $trail->parent('backend')->push('Emails', route('backend.emails.index'))
);

Breadcrumbs::for(
    'email',
    fn (Generator $trail) => $trail->parent('emails')->push('Gesendete E-Mails', route('backend.emails.index'))
);

Breadcrumbs::for(
    'kassenbuch',
    fn (Generator $trail) => $trail->parent('backend')->push('Kassenbuch', route('backend.cashBook.index'))
);
