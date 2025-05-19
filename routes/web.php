<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\AuthController;




// Users
use App\Http\Controllers\Business\User\UserController;

//Company
use App\Http\Controllers\Business\Company\CompanyController;

//Domain
use App\Http\Controllers\Business\Domain\DomainController;

//Department
use App\Http\Controllers\Business\Department\DepartmentController;

//Employee
use App\Http\Controllers\Business\Employee\EmployeeController;

//Certificate
use App\Http\Controllers\Business\Certificate\CertificateController;

// Service
use App\Http\Controllers\Business\Service\ServiceController;

// Email
use App\Http\Controllers\Business\Email\EmailController;

// License
use App\Http\Controllers\Business\License\LicenseController;


/*
|--------------------------------------------------------------------------
| AUTHENTICATE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [AuthController::class, 'loginView']);
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1')->name('login');

Route::get('/register', [AuthController::class, 'registerView']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::any('/logout', [AuthController::class, 'destroy'])->name('logout');

/*
|--------------------------------------------------------------------------
| WEB ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Users
    Route::resource('user', UserController::class);
    
    Route::resource('company', CompanyController::class);
    
    Route::resource('domain', DomainController::class);
    
    Route::resource('department', DepartmentController::class);
    
    Route::resource('employee', EmployeeController::class);
    
    Route::resource('service', ServiceController::class);
    
    Route::resource('email', EmailController::class);
    
    Route::resource('servicecontrol', UserController::class);
    
    Route::resource('certificate', CertificateController::class);
    
    Route::resource('device', UserController::class);
    
    Route::resource('license', LicenseController::class);
    
    Route::resource('devicecontrol', UserController::class);
});










/* 
* ---------- ANOTAÇÕES -----------
/

AS CORES PARA <span class="badge badge-sm border border-primary text-info bg-success">

text-primary: cor do texto
border-primary: cor da borda dos elementos
bg-primary: Cor de fundo das coisas 

        primary: roxo
        success: verde
        danger: vermelho
        info: azul
        warning: laranja
        light: cinza claro
        dark: cinza escuro (Quase preto)


*/