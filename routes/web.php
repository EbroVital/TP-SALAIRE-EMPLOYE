<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\paymentController;
use App\Models\Departement;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handleLogin'])->name('handleLogin');

Route::get('/validate-account/{email}', [AdminController::class, 'defineAccess']);
Route::post('/validate-account/{email}', [AdminController::class, 'SubmitdefineAccess'])->name('submit');

// route securisée

Route::middleware('auth')->group(function (){
    Route::get('dashboard', [dashboardController::class, 'index'])->name('dashboard');

    Route::prefix('employe')->group( function(){
        Route::get('/', [EmployeController::class, 'index'])->name('employe.index');
        Route::get('/create', [EmployeController::class, 'create'])->name('employe.create');
        Route::get('/edit/{employe}', [EmployeController::class, 'edit'])->name('employe.edit');
        Route::post('/store', [EmployeController::class, 'store'])->name('employe.store');
        Route::put('/update/{employe}', [EmployeController::class, 'update'])->name('employe.update');
        Route::get('/delete/{employe}', [EmployeController::class, 'delete'])->name('employe.delete');

    });

    Route::prefix('departement')->group( function(){
        Route::get('/', [DepartementController::class, 'index'])->name('departement.index');
        Route::get('/create', [DepartementController::class, 'create'])->name('departement.create');
        Route::post('/', [DepartementController::class, 'store'])->name('departement.store');
        Route::get('/edit/{departement}', [DepartementController::class, 'edit'])->name('departement.edit');
        Route::put('/update/{departement}', [DepartementController::class, 'update'])->name('departement.update');
        Route::get('/{departement}', [DepartementController::class, 'delete'])->name('departement.delete');
    });

    Route::prefix('configuration')->group( function(){
        Route::get('/', [ConfigurationController::class, 'index'])->name('configuration.index');
        Route::get('/create', [ConfigurationController::class, 'create'])->name('configuration.create');
        Route::post('/store', [ConfigurationController::class, 'store'])->name('configuration.store');
        Route::get('/{configuration}', [ConfigurationController::class, 'delete'])->name('configuration.delete');
    });


    Route::prefix('admin')->group(function (){

        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('/delete/{user}', [AdminController::class, 'delete'])->name('admin.delete');
    });

    Route::prefix('payment')->group(function (){

        Route::get('/', [paymentController::class, 'index'])->name('payments');
        Route::get('/make', [paymentController::class, 'initPayment'])->name('payment.initPayment');
        Route::get('/download-invoice/{payment}', [paymentController::class, 'downloadInvoice'])->name('payment.download');
    });


});




