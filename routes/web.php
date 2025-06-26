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

// Employee
use App\Http\Controllers\Business\Employee\EmployeeController;

// Certificate
use App\Http\Controllers\Business\Certificate\CertificateController;

// Service
use App\Http\Controllers\Business\Service\ServiceController;

// Email
use App\Http\Controllers\Business\Email\EmailController;

// Device
use App\Http\Controllers\Business\Device\DeviceController;
use App\Http\Controllers\Business\Device\DeviceType\DeviceTypeController;
use App\Http\Controllers\Business\Device\DeviceBrand\DeviceBrandController;
use App\Http\Controllers\Business\Device\DeviceModel\DeviceModelController;
use App\Http\Controllers\Business\Device\DeviceControl\DeviceControlController;

// Heritage
use App\Http\Controllers\Business\Heritage\HeritageController;
use App\Http\Controllers\Business\Heritage\HeritageType\HeritageTypeController;
use App\Http\Controllers\Business\Heritage\HeritageBrand\HeritageBrandController;
use App\Http\Controllers\Business\Heritage\HeritageModel\HeritageModelController;
use App\Http\Controllers\Business\Heritage\HeritageControl\HeritageControlController;

// License
use App\Http\Controllers\Business\License\LicenseController;

// Charts
use App\Http\Controllers\Common\ChartController;

//  Ticket
use App\Http\Controllers\Business\Tickets\TicketController;
use App\Http\Controllers\Business\Tickets\TicketCategoryController;
use App\Http\Controllers\Business\Tickets\TicketCollaboratorController;

//Maintenance
use App\Http\Controllers\Business\Maintenance\MaintenanceController;
use App\Http\Controllers\Business\Tickets\TicketStatusController;

// Task
use App\Http\Controllers\Business\Task\TaskController;
use App\Http\Controllers\Business\Task\KanbanController;
use App\Http\Controllers\Business\Task\TaskStatusController;

// Logs
use App\Http\Controllers\Log\ActivityLogController;

//Collaborator
use App\Http\Controllers\Collaborator\CollaboratorController;

//Chip
use App\Http\Controllers\Business\Chip\ChipController;
use App\Http\Controllers\Business\Chip\ChipControl\ChipControlController;
use App\Http\Controllers\Business\Chip\PhoneOperator\PhoneOperatorController;



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

    Route::resource('operator', PhoneOperatorController::class);

    Route::resource('chipcontrol', ChipControlController::class);

    Route::resource('chip', ChipController::class);       
    
    });



    // Devices
    Route::group(['prefix' => 'device'], function () {
        Route::resource('/', DeviceController::class)->names('device');

        Route::group(['prefix' => 'type'], function () {
            Route::resource('/', DeviceTypeController::class)->except('show')->names('device_type');
            Route::get('search', [DeviceTypeController::class, 'search'])->name('device_type.search');
        });

        Route::group(['prefix' => 'brand'], function () {
            Route::resource('/', DeviceBrandController::class)->except('show')->names('device_brand');
            Route::get('search', [DeviceBrandController::class, 'search'])->name('device_brand.search');
        });

        Route::group(['prefix' => 'model'], function () {
            Route::resource('/', DeviceModelController::class)->except('show')->names('device_model');
            Route::get('search', [DeviceModelController::class, 'search'])->name('device_model.search');
        });

        Route::resource('control', DeviceControlController::class)->names('device_control');
    });

    // Heritages
    Route::group(['prefix' => 'heritage'], function () {
        Route::resource('/', HeritageController::class)->names('heritage');

        Route::group(['prefix' => 'type'], function () {
            Route::resource('/', HeritageTypeController::class)->except('show')->names('heritage_type');
            Route::get('search', [HeritageTypeController::class, 'search'])->name('heritage_type.search');
        });

        Route::group(['prefix' => 'brand'], function () {
            Route::resource('/', HeritageBrandController::class)->except('show')->names('heritage_brand');
            Route::get('search', [HeritageBrandController::class, 'search'])->name('heritage_brand.search');
        });

        Route::group(['prefix' => 'model'], function () {
            Route::resource('/', HeritageModelController::class)->except('show')->names('heritage_model');
            Route::get('search', [HeritageModelController::class, 'search'])->name('heritage_model.search');
        });

        Route::resource('control', HeritageControlController::class)->names('heritage_control');
    });

    Route::resource('license', LicenseController::class);

    // Tickets
    Route::group(['prefix' => 'ticket'], function () {
        Route::resource('/', TicketController::class)->names('ticket');
        Route::post('ticket-status/update/{ticketId}', [TicketStatusController::class, 'openToInProgress'])->name('update-ticket-status-open');
        Route::resource('category', TicketCategoryController::class)->names('ticket_category');
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/ticket/collaborator/create', [TicketCollaboratorController::class, 'create'])->name('ticket.collaborator.create');
        Route::get('/ticket/collaborator/index', [TicketCollaboratorController::class, 'index'])->name('ticket.collaborator.index');
    });


    // Tasks

    Route::resource('maintenance', MaintenanceController::class);

    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

    Route::resource('/collaborator', CollaboratorController::class);

    Route::resource('/task', TaskController::class);

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
