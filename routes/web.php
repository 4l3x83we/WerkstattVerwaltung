<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterCompletedController;
use App\Http\Livewire\Admin\Permission\Edit;
use App\Http\Livewire\Admin\User\Create;
use App\Http\Livewire\Admin\User\Index;
use App\Http\Livewire\Admin\User\Register;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:super_admin|admin|garage'])->name('dashboard');

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
        Route::get('einstellungen', App\Http\Livewire\Admin\Settings\Index::class)->name('settings.index')->middleware('role:super_admin|admin');
    });

    // Backend
    Route::prefix('backend')->name('backend.')->group(function () {

    });
});

require __DIR__.'/auth.php';
