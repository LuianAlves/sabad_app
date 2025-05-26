<?php

use Illuminate\Support\Facades\Route;

// Auth
use App\Http\Controllers\Auth\AuthController;

// Dashboard
use App\Http\Controllers\Common\DashboardController;

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

//Device
use App\Http\Controllers\Business\Device\DeviceController;
use App\Http\Controllers\Business\Device\DeviceType\DeviceTypeController;
use App\Http\Controllers\Business\Device\DeviceBrand\DeviceBrandController;
use App\Http\Controllers\Business\Device\DeviceModel\DeviceModelController;
use App\Http\Controllers\Business\Device\DeviceControl\DeviceControlController;

// License
use App\Http\Controllers\Business\License\LicenseController;

// Charts
use App\Http\Controllers\Common\ChartController;

//  Tickets
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketCategoryController;

// Logs
use App\Http\Controllers\Log\ActivityLogController;

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
| RESOURCE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');

    Route::resource('user', UserController::class);

    Route::resource('company', CompanyController::class);

    Route::resource('domain', DomainController::class);

    Route::resource('department', DepartmentController::class);

    Route::resource('employee', EmployeeController::class);

    Route::resource('service', ServiceController::class);

    Route::resource('email', EmailController::class);

    Route::resource('servicecontrol', UserController::class);

    Route::resource('certificate', CertificateController::class);

    Route::resource('device', DeviceController::class);

    Route::resource('device_type', DeviceTypeController::class)->except('show');
    Route::get('/device_type/search', [DeviceTypeController::class, 'search'])->name('device_type.search');
    
    Route::resource('device_brand', DeviceBrandController::class)->except('show');
    Route::get('/device_brand/search', [DeviceBrandController::class, 'search'])->name('device_brand.search');
    
    Route::resource('device_model', DeviceModelController::class)->except('show');
    Route::get('/device_model/search', [DeviceModelController::class, 'search'])->name('device_model.search');

    Route::resource('device_control', DeviceControlController::class);

    Route::resource('license', LicenseController::class);


    Route::resource('ticket', TicketController::class);
    Route::resource('ticket_category', TicketCategoryController::class);

    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');
});

/*
|--------------------------------------------------------------------------
| CHART ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::group(['prefix' => 'charts'], function () {
        /* --->| Employee per Department |<--- */
        Route::get('/employee', [ChartController::class, 'employeePerDepartment']);
    });
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