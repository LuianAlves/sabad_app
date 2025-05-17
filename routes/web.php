<?php

use Illuminate\Support\Facades\Route;

// Users
use App\Http\Controllers\Business\User\UserController;

//Company
use App\Http\Controllers\Business\Company\CompanyController;

//Domain
use App\Http\Controllers\Business\Domain\DomainController;

// ----------> Routes

// Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Users
    Route::resource('user', UserController::class);
    
    Route::resource('company', CompanyController::class);
    
    Route::resource('domain', DomainController::class);
    
    Route::resource('departament', UserController::class);
    
    Route::resource('employee', UserController::class);
    
    Route::resource('service', UserController::class);
    
    Route::resource('email', UserController::class);
    
    Route::resource('servicecontrol', UserController::class);
    
    Route::resource('certificate', UserController::class);
    
    Route::resource('device', UserController::class);
    
    Route::resource('license', UserController::class);
    
    Route::resource('devicecontrol', UserController::class);

// });
