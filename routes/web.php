<?php

use App\Http\Controllers\Auth\PermissionController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\Business\RecordControl\RecordControlController;
use App\Http\Controllers\Business\Room\RoomController;
use App\Http\Controllers\Business\Training\Training\TrainingController;
use App\Http\Controllers\Business\Training\TrainingClass\TrainingClassController;
use App\Http\Controllers\Business\Training\TrainingParticipant\TrainingParticipantController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SalaryBandController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\UnionAdjustmentController;
use App\Http\Controllers\UnionController;
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

//Extension
use App\Http\Controllers\Business\Extension\ExtensionController;

//Chat
use App\Http\Controllers\Business\Chat\ChatController;

use App\Http\Controllers\Business\Booking\BookingController;

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

    Route::resource('/company', CompanyController::class);

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

    Route::resource('extension', ExtensionController::class);

    Route::resource('room', RoomController::class);

    Route::resource('record_controls', RecordControlController::class);

    Route::resource('cost', CostController::class);
    Route::get('cost-report', [CostController::class, 'report'])->name('cost.report');

    Route::group(['prefix' => 'bookings'], function () {
        Route::get('/', [BookingController::class, 'index'])->name('bookings.index');
        Route::get('/{room}/create', [BookingController::class, 'create'])->name('bookings.create');
        Route::get('/{room}', [BookingController::class, 'show'])->name('bookings.show');
        Route::post('/{room}', [BookingController::class, 'store'])->name('bookings.store');
    });

    Route::group(['prefix' => 'notifications'], function () {
        Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        Route::post('/', [NotificationController::class, 'store'])->name('notifications.store');
        Route::get('/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
        Route::get('/unread', [NotificationController::class, 'unread'])->name('notifications.unread');
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::post('/send', [ChatController::class, 'send'])->name('chat.send');
        Route::get('/messages/{userId}', [ChatController::class, 'messages'])->name('chat.messages');
        Route::get('/check/message', [ChatController::class, 'checkMessages'])->name('check.messages');
        Route::get('/check-messages', [UserController::class, 'checkMessages']);
    });

    Route::get('/contacts', [ChatController::class, 'contacts'])->name('contacts.index');

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

    Route::get('/ticket/collaborator/create', [TicketCollaboratorController::class, 'create'])->name('ticket.collaborator.create');
    Route::get('/ticket/collaborator/index', [TicketCollaboratorController::class, 'index'])->name('ticket.collaborator.index');

    Route::resource('maintenance', MaintenanceController::class);

    Route::get('/activity-log', [ActivityLogController::class, 'index'])->name('activity-log.index');

    Route::resource('/collaborator', CollaboratorController::class);

    // Tasks
    Route::resource('/task', TaskController::class);

    // Trainings
    Route::resource('/training', TrainingController::class)->names('training');

    Route::resource('/training-class', TrainingClassController::class)->except('index', 'create');

    Route::get('/training-class', [TrainingClassController::class, 'index'])->name('training-class.index');
    Route::get('/training/training-class/create/{trainingId}', [TrainingClassController::class, 'create'])->name('training-class.create');
    Route::post('/training/{trainingClassId}/email', [TrainingClassController::class, 'sendEmail'])->name('training.send-email');

    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('union.adjustment', UnionAdjustmentController::class)->shallow();
    Route::resource('union', UnionController::class);

    Route::resource('tier_levels.salary_bands', SalaryBandController::class)->shallow();
    Route::resource('hierarchical_levels.tier_levels', CostController::class)->shallow();

    // mostra a estrutura salarial
    Route::get('company/{company}/company_structure', [CompanyController::class,'structure'])->name('companies.company_structure');

    // aplicar o dissídio
    Route::post('company/{company}/apply-adjustment', [CompanyController::class,'applyAdjustment'])->name('companies.applyAdjustment');


    /*
    |--------------------------------------------------------------------------
    | CHART ROUTES
    |--------------------------------------------------------------------------
    */

    Route::group(['prefix' => 'charts'], function () {
        /* --->| Employee per Department |<--- */
        Route::get('/employee', [ChartController::class, 'employeePerDepartment']);
    });
});
