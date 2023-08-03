<?php

use App\Http\Controllers\Admin\Settings\CompanySettingsController;
use App\Http\Controllers\Backend\Customers\CustomerController;
use App\Http\Controllers\Backend\Office\History\HistoryController;
use App\Http\Controllers\Backend\Office\Invoice\DraftController;
use App\Http\Controllers\Backend\Office\Invoice\InvoiceAllController;
use App\Http\Controllers\Backend\Office\Invoice\InvoiceController;
use App\Http\Controllers\Backend\Office\Invoice\InvoiceCreditController;
use App\Http\Controllers\Backend\Office\Invoice\InvoicePaidController;
use App\Http\Controllers\Backend\Office\Offer\OfferController;
use App\Http\Controllers\Backend\Office\Order\OrderController;
use App\Http\Controllers\Backend\Office\PDF\WorkOrderController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\ProductsController;
use App\Http\Controllers\Backend\Reports\CardPaymentController;
use App\Http\Controllers\Backend\Reports\CashBookController;
use App\Http\Controllers\Backend\Reports\CashRegisterController;
use App\Http\Controllers\Backend\Reports\PositionsController;
use App\Http\Controllers\Backend\Reports\RevenueController;
use App\Http\Controllers\Backend\Reports\SalesVolumeController;
use App\Http\Controllers\Backend\Vehicles\VehicleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterCompletedController;
use App\Http\Livewire\Admin\Permission\Edit;
use App\Http\Livewire\Admin\User\Create;
use App\Http\Livewire\Admin\User\Index;
use App\Http\Livewire\Admin\User\Show;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware(['auth', 'role:super_admin|admin|garage|user']);

Route::middleware(['auth', 'role:uncompleted'])->group(function () {
    Route::get('register/2', [RegisterCompletedController::class, 'index'])->name('register.2');
    Route::post('register/{user}', [RegisterCompletedController::class, 'update'])->name('register.update');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'role:super_admin|admin|garage'])->name('dashboard');

Route::middleware(['auth', 'role:super_admin|admin|garage'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:super_admin|admin|garage'])->group(function () {

    // Admin
    Route::prefix('admin')->name('admin.')->group(function () {
        // Admin -> User
        Route::get('/benutzer', Index::class)->name('users.index')->middleware(['role:super_admin|admin']);
        Route::prefix('benutzer')->name('users.')->group(function () {
            Route::get('/erstellen', Create::class)->name('create')->middleware(['role:super_admin|admin']);
            Route::get('/{id}', Show::class)->name('show');
        });
        // Admin -> Rollen
        Route::get('/rollen', \App\Http\Livewire\Admin\Role\Index::class)->name('roles.index');
        Route::prefix('rollen')->name('roles.')->group(function () {
            Route::get('/erstellen', \App\Http\Livewire\Admin\Role\Create::class)->name('create')->middleware(['role:super_admin|admin']);
            Route::get('/{id}', \App\Http\Livewire\Admin\Role\Show::class)->name('show')->middleware(['role:super_admin|admin']);
        });
        // Admin -> Berechtigungen
        Route::get('/berechtigungen', \App\Http\Livewire\Admin\Permission\Index::class)->name('permission.index');
        Route::prefix('berechtigungen')->name('permission.')->group(function () {
            Route::get('/erstellen', \App\Http\Livewire\Admin\Permission\Create::class)->name('create')->middleware(['role:super_admin|admin']);
            Route::get('/{id}/bearbeiten', Edit::class)->name('edit')->middleware(['role:super_admin|admin']);
        });
        // Admin -> Einstellungen
        Route::get('einstellungen', [CompanySettingsController::class, 'index'])->name('einstellungen.index')->middleware('role:super_admin|admin');
        Route::get('imports', [CompanySettingsController::class, 'importPage'])->name('imports.index')->middleware('role:super_admin|admin');
    });

    // Backend
    Route::prefix('backend')->name('backend.')->group(function () {
        // Backend -> Historie
        Route::get('historie/{id}', [HistoryController::class, 'index'])->name('history.index');

        Route::prefix('buero')->group(function () {
            // Backend -> Office -> Offer
            Route::resource('angebote', OfferController::class)->only('index', 'create', 'edit', 'show');
            Route::post('angebote/import', [OfferController::class, 'import'])->name('angebote.import');
            Route::get('angebote/export/pdf/{angebote}', [OfferController::class, 'pdf'])->name('angebote.pdf');
            // Backend -> -> Office -> Invoice -> Order
            Route::resource('auftraege', OrderController::class)->only('index', 'create', 'edit', 'show');
            Route::get('auftraege/create/{id}', [OrderController::class, 'createID'])->name('auftraege.create-id');
            Route::get('auftraege/print/pdf/{rechnung}', [\App\Http\Controllers\Backend\Office\PDF\OrderController::class, 'printPDF'])->name('auftraege.print.pdf');
            Route::get('auftraege/download/pdf/{rechnung}', [\App\Http\Controllers\Backend\Office\PDF\OrderController::class, 'downloadPDF'])->name('auftraege.download.pdf');
            Route::get('arbeitsauftrag/print/pdf/{rechnung}', [WorkOrderController::class, 'printPDF'])->name('arbeitsauftrag.print.pdf');
            Route::get('arbeitsauftrag/download/pdf/{rechnung}', [WorkOrderController::class, 'downloadPDF'])->name('arbeitsauftrag.download.pdf');
            Route::prefix('rechnung')->name('invoice.')->group(function () {
                // Backend -> -> Office -> Invoice -> Draft
                Route::resource('entwurf', DraftController::class)->only('index', 'create', 'edit', 'show');
                Route::get('entwurf/print/pdf/{rechnung}', [\App\Http\Controllers\Backend\Office\PDF\DraftController::class, 'printPDF'])->name('entwurf.print.pdf');
                Route::get('entwurf/download/pdf/{rechnung}', [\App\Http\Controllers\Backend\Office\PDF\DraftController::class, 'downloadPDF'])->name('entwurf.download.pdf');
                // Backend -> -> Office -> Invoice -> Open
                Route::resource('offen', InvoiceController::class)->only('index', 'create', 'edit', 'show');
                Route::post('offen/import', [InvoiceController::class, 'import'])->name('rechnung.import');
                Route::get('offen/export/pdf/{rechnung}', [InvoiceController::class, 'pdf'])->name('rechnung.pdf');
                // Backend -> -> Office -> Invoice -> Paid
                Route::resource('bezahlt', InvoicePaidController::class)->only('index', 'show');
                Route::post('bezahlt/import', [InvoicePaidController::class, 'import'])->name('rechnung.import');
                Route::get('bezahlt/export/pdf/{rechnung}', [InvoicePaidController::class, 'pdf'])->name('rechnung.pdf');
                // Backend -> -> Office -> Invoice -> Credit
                Route::resource('storno', InvoiceCreditController::class)->only('index', 'show');
                Route::post('storno/import', [InvoiceCreditController::class, 'import'])->name('rechnung.import');
                Route::get('storno/print/pdf/{rechnung}', [InvoiceCreditController::class, 'printPDF'])->name('storno.print.pdf');
                Route::get('storno/download/pdf/{rechnung}', [InvoiceCreditController::class, 'downloadPDF'])->name('storno.download.pdf');
                // Backend -> -> Office -> Invoice -> All
                Route::resource('alle', InvoiceAllController::class)->only('index', 'show');
                Route::post('alle/import', [InvoiceAllController::class, 'import'])->name('rechnung.import');
                Route::get('alle/print/pdf/{rechnung}', [\App\Http\Controllers\Backend\Office\PDF\InvoiceController::class, 'printPDF'])->name('print.pdf');
                Route::get('alle/download/pdf/{rechnung}', [\App\Http\Controllers\Backend\Office\PDF\InvoiceController::class, 'downloadPDF'])->name('download.pdf');
            });
        });
        Route::prefix('stammdaten')->group(function () {
            // Backend -> Kunden
            Route::resource('kunden', CustomerController::class)->only('index', 'create', 'edit', 'show');
            Route::post('kunden/import', [CustomerController::class, 'import'])->name('kunden.import');
            // Backend -> Historie
            Route::get('kunden/historie/{id}', [HistoryController::class, 'index'])->name('history.index');
            // Backend -> Fahrzeuge
            Route::resource('fahrzeuge', VehicleController::class)->only('index', 'create', 'edit', 'show');
            Route::post('fahrzeuge/import', [VehicleController::class, 'import'])->name('fahrzeuge.import');
            Route::post('fahrzeuge/brands/import', [VehicleController::class, 'brandsImport'])->name('fahrzeuge.brands.import');
            Route::post('fahrzeuge/models/import', [VehicleController::class, 'modelsImport'])->name('fahrzeuge.models.import');
            Route::post('fahrzeuge/brands/models/import', [VehicleController::class, 'brandsModelsImport'])->name('fahrzeuge.brands.models.import');
            Route::get('fahrzeuge/export/pdf', [VehicleController::class, 'pdf'])->name('fahrzeuge.pdf');
            // Backend -> Product
            Route::resource('produkte', ProductsController::class)->only('index', 'create', 'edit', 'show');
            Route::post('produkte/import', [ProductsController::class, 'import'])->name('produkte.import');
            // Backend -> Product -> Kategorie
            Route::resource('kategorie', CategoryController::class)->only('index', 'create', 'edit', 'show');
            Route::post('kategorie/import', [CategoryController::class, 'import'])->name('kategorie.import');
            // Backend -> Rechnung
        });
        Route::prefix('berichte')->name('berichte.')->group(function () {
            Route::get('rechnung', [\App\Http\Controllers\Backend\Reports\InvoiceController::class, 'index'])->name('invoice.index');
            Route::get('einnahmen', [RevenueController::class, 'index'])->name('revenue.index');
            Route::get('umsatz', [SalesVolumeController::class, 'index'])->name('sales-volume.index');
            Route::get('kassenbuch', [CashBookController::class, 'index'])->name('cash-book.index');
            Route::get('kartenzahlung', [CardPaymentController::class, 'index'])->name('card-payment.index');
            Route::get('registerkasse', [CashRegisterController::class, 'index'])->name('cash-register.index');
            Route::get('positionen', [PositionsController::class, 'index'])->name('positions.index');
        });
        Route::prefix('emails')->name('emails.')->group(function () {
            Route::get('email', [App\Http\Controllers\Backend\Emails\EmailsController::class, 'index'])->name('index');
        });
        Route::get('kassenbuch', [\App\Http\Controllers\Backend\CashBookController::class, 'index'])->name('cashBook.index');
    });
});

require __DIR__.'/auth.php';
