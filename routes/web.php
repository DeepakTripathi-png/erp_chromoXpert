<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Login\ForgotPasswordController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Petparent\PetparentController;
use App\Http\Controllers\Admin\Pet\PetController;
use App\Http\Controllers\Admin\Appointments\AppointmentsController;
use App\Http\Controllers\Admin\Barcode\BarcodeController;
use App\Http\Controllers\Admin\Branch\BranchController;
use App\Http\Controllers\Admin\Departments\DepartmentController;
use App\Http\Controllers\Admin\Testcase\TestcaseController;
use App\Http\Controllers\Admin\Report\ReportController;
use App\Http\Controllers\Admin\Revenu\RevenuController;
use App\Http\Controllers\Admin\RefereeDoctor\RefereeDoctorController;
use App\Http\Controllers\Admin\InternalDoctor\InternalDoctorController;
use App\Http\Controllers\Admin\Invoice\InvoiceController;
use App\Http\Controllers\Admin\Notification\NotificationController;
use App\Http\Controllers\Admin\Location\LocationController;
use App\Http\Controllers\Admin\Settings\GeneralSettings;
use App\Http\Controllers\Admin\Settings\VisualSettings;
use App\Http\Controllers\Admin\SystemUsers\RolesPrivilegesController;
use App\Http\Controllers\Admin\SystemUsers\SystemUserController;
use App\Http\Controllers\Admin\NotFoundController\NotFoundController;
use App\Http\Controllers\Admin\TestProfile\TestProfileController;
use App\Http\Controllers\BaseController;

// Utility Routes
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'storage linked';
})->name('link.storage');

Route::get('/clear', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return 'clear';
})->name('clear');

// Frontend Routes
Route::get('/', function () {
    return redirect('/admin');
})->name('home');

// Authentication Routes
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/admin', [LoginController::class, 'index'])->name('admin.login');
});

Route::post('/login-action', [LoginController::class, 'admin_login'])->name('login');

Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('/reset-password', function () {
    return abort(404);
});

// Admin Backend Routes
Route::group(['prefix' => 'admin', 'middleware' => ['prevent-back-history', 'is_admin']], function () {
    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/doctor/dashboard', 'doctorDashboard')->name('doctor.dashboard');
    });

    // Appointment Routes
    Route::controller(AppointmentsController::class)->group(function () {
        Route::get('/appointments', 'index')->name('appointments.index');
        Route::get('/appointments/add', 'add')->name('appointments.add');
        Route::get('/appointments/reciept/{id}', 'viewReciept')->name('appointments.receipt');
        Route::post('/appointments/store', 'store')->name('appointments.store');
        Route::get('/get-pet-details/{pet_id}', 'getPetDetails')->name('get.pet.details');
        Route::get('/get-pet-details-by-code/{pet_code}', 'getPetDetailsByCode')->name('get.pet.details.by.code');
        Route::get('/apointment/test/data-table', 'add_data_table')->name('appointments.test.data_table');
        Route::post('/appointments/pet-and-petparent/store', 'petAndPetparentStore')->name('pet-and-parent.store');
        Route::get('/apointment/data-table', 'data_table')->name('appointments.data_table');
        Route::get('/appointment/edit/{id}', 'edit')->name('appointments.edit');
    });

    // Barcode Routes
    Route::controller(BarcodeController::class)->group(function () {
        Route::get('/barcode/{appointment_id}', 'show')->name('barcode.show');
        Route::post('/barcode-save', 'save')->name('barcode.save');
    });

    // Invoice Routes
    Route::controller(InvoiceController::class)->group(function () {
        Route::get('/invoice/{id}', 'generateInvoice')->name('invoice.print');
    });

    // Branch Routes
    Route::controller(BranchController::class)->group(function () {
        Route::get('/branches', 'index')->name('branches.index');
        Route::get('/branches/add', 'add')->name('branches.add');
        Route::post('/branches/store', 'store')->name('branch.store');
        Route::get('/branches/data-table', 'data_table')->name('branches.data_table');
        Route::get('/branches/edit/{id}', 'edit')->name('branches.edit');
        Route::get('/branches/view/{id}', 'view')->name('branches.view');
        Route::get('/get-states/{countryId}', 'getStates')->name('branches.get_states');
        Route::get('/get-cities/{stateId}', 'getCities')->name('branches.get_cities');
    });

    // Department Routes
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index')->name('department.index');
        Route::get('/departments/add', 'add')->name('departments.add');
        Route::post('/departments/store', 'store')->name('department.store');
        Route::get('/departments/edit/{id}', 'edit')->name('departments.edit');
        Route::get('/departments/view/{id}', 'view')->name('departments.view');
        Route::get('/departments/data-table', 'data_table')->name('departments.data_table');
    });

    // Pet Parent Routes
    Route::controller(PetparentController::class)->group(function () {
        Route::get('/parent', 'index')->name('petparent.index');
        Route::get('/parent/add', 'add')->name('petparent.add');
        Route::post('/parent/store', 'store')->name('petparent.store');
        Route::get('/parent/data-table', 'data_table')->name('petparent.data_table');
        Route::get('/parent/edit/{id}', 'edit')->name('petparent.edit');
        Route::get('/get-owner-pets-by-phone/{phone}', 'getOwnerPetsByPhone')->name('get.owner.pets.by.phone');
    });

    // Pet Routes
    Route::controller(PetController::class)->group(function () {
        Route::get('/pet', 'index')->name('pet.index');
        Route::get('/pet/add', 'add')->name('pet.add');
        Route::get('/pet/edit/{id}', 'edit')->name('pet.edit');
        Route::post('/pet/store', 'store')->name('pet.store');
        Route::get('/pet/data-table', 'data_table')->name('pet.data_table');
        Route::get('/pet/view/{id}', 'view')->name('pet.view');
    });

    // Internal Doctor Routes
    Route::controller(InternalDoctorController::class)->group(function () {
        Route::get('/internal-doctors', 'index')->name('internaldoctors.index');
        Route::get('/internal-doctors/add', 'add')->name('internaldoctors.add');
        Route::post('/internal-doctor/store', 'store')->name('internaldoctor.store');
        Route::get('/internal-doctor/data-table', 'data_table')->name('internaldoctors.data_table');
        Route::get('/internal-doctor/edit/{id}', 'edit')->name('internaldoctors.edit');
        Route::get('/internal-doctor/view/{id}', 'view')->name('internaldoctors.view');
        Route::get('/internal-doctor/delete/{id}', 'delete')->name('internaldoctors.delete');
    });

    // Referee Doctor Routes
    Route::controller(RefereeDoctorController::class)->group(function () {
        Route::get('/referee-doctors', 'index')->name('refereedoctors.index');
        Route::get('/referee-doctors/add', 'add')->name('refereedoctors.add');
        Route::post('/referee-doctor/store', 'store')->name('refereedoctor.store');
        Route::get('/referee-doctor/data-table', 'data_table')->name('refereedoctors.data_table');
        Route::get('/referee-doctor/edit/{id}', 'edit')->name('refereedoctors.edit');
        Route::post('/refereedoctor/store-ajax', 'storeAjax')->name('refereedoctor.store-ajax');
    });

    // Test Case Routes
    Route::controller(TestcaseController::class)->group(function () {
        Route::get('/test-case', 'index')->name('admin.testcases');
        Route::get('/test-case/add', 'add')->name('testcases.add');
        Route::get('/test-case/edit/{id}', 'edit')->name('testcases.edit');
        Route::get('/test-case/view/{id}', 'view')->name('testcases.view');
        Route::post('/tests/store', 'store')->name('admin.test_case.store');
        Route::get('/test/data-table', 'data_table')->name('testcases.data_table');
        Route::get('/tests/search', 'search')->name('tests.search');
    });

    // Test Profile Routes
    Route::controller(TestProfileController::class)->group(function () {
        Route::get('/test-profile', 'index')->name('testprofile.index'); 
        Route::get('/testprofile/edit/{id}', 'edit')->name('testprofile.edit');
        Route::post('/test-profile/store', 'store')->name('testprofile.store');
        Route::get('/test-profile/data-table', 'data_table')->name('testprofile.data_table');
        
    });

    // Report Routes
    Route::controller(ReportController::class)->group(function () {
        Route::get('/report', 'index')->name('reports.index');
        Route::get('/generate-reports/{id}', 'getGenerateReport')->name('reports.generate');
        Route::get('/reports/view/{id}', 'viewReport')->name('reports.view');
        Route::get('/report/data-table', 'data_table')->name('reports.data_table');
        Route::post('/reports/store', 'store')->name('reports.store');
        Route::post('/reports/pdf', 'reportPdf')->name('reports.pdf');
    });

    // Revenue Routes
    Route::controller(RevenuController::class)->group(function () {
        Route::get('/revenu', 'index')->name('revenue.index');
        Route::get('/revenu/view', 'view')->name('revenue.view');
    });

    // Notification Routes
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notification', 'index')->name('notification.index');
    });

    // Location Routes
    Route::controller(LocationController::class)->group(function () {
        Route::get('/get-states/{country_id}', 'getStates')->name('get.states');
        Route::get('/get-cities/{state_id}', 'getCities')->name('get.cities');
    });

    // Settings Routes
    Route::controller(GeneralSettings::class)->group(function () {
        Route::get('/general-setting', 'index')->name('general.settings.index');
        Route::post('/general-settings-store', 'store')->name('general.settings.store');
    });

    Route::controller(VisualSettings::class)->group(function () {
        Route::get('/visual-setting', 'index')->name('visual.settings.index');
        Route::post('/visual-settings-store', 'store')->name('visual.settings.store');
    });

    // System User and Role Routes
    Route::controller(RolesPrivilegesController::class)->group(function () {
        Route::get('/roles-privileges', 'index')->name('roles-privileges.index');
        Route::get('/roles-privileges/add', 'create')->name('roles-privileges.add');
        Route::post('/roles-privileges/store', 'store')->name('roles-privileges.store');
        Route::get('/roles-privileges/data-table', 'data_table')->name('roles-privileges.data_table');
        Route::get('/roles-privileges/edit/{id}', 'edit')->name('roles-privileges.edit');
        Route::get('/roles-privileges/check-role-exist', 'check_role_exist')->name('roles-privileges.check_role_exist');
    });

    Route::controller(SystemUserController::class)->group(function () {
        Route::get('/system-user', 'index')->name('system-user.index');
        Route::get('/system-user/add', 'create')->name('system-user.add');
        Route::post('/system-user/store', 'store')->name('system-user.store');
        Route::get('/system-user/data-table', 'data_table')->name('system-user.data_table');
        Route::get('/system-user/edit/{id}', 'edit')->name('system-user.edit');
        Route::get('/system-user/check-user-exist', 'check_user_exist')->name('system-user.check_user_exist');
    });

    // Authentication Management Routes
    Route::controller(LoginController::class)->group(function () {
        Route::get('/change-password', 'view_change_password')->name('change.password');
        Route::post('/change-password', 'change_password')->name('change.password.post');
        Route::get('/logout', 'logout')->name('logout');
    });

    // Base Controller Routes
    Route::controller(BaseController::class)->group(function () {
        Route::get('/sub-category-list', 'subCategoryList')->name('subcategory.list');
        Route::get('/common-delete', 'delete')->name('common.delete');
        Route::post('/change-status', 'status')->name('change-status');
    });

    // 404 Route
    Route::get('/404', [NotFoundController::class, 'index'])->name('notfound');
});



// Doctor Authentication Routes
// Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/doctor', [App\Http\Controllers\Doctor\Login\DoctorLoginController::class, 'index'])->name('doctor.login');
    Route::post('/doctor/login-action', [App\Http\Controllers\Doctor\Login\DoctorLoginController::class, 'login'])->name('doctor.login.post');
// });

Route::group(['prefix' => 'doctor', 'middleware' => ['prevent-back-history', 'is_doctor']], function () {
    Route::get('/dashboard', function () {
        return view('Doctor.Dashboard.index');
    })->name('doctor.dashboard');
    Route::get('/logout', [App\Http\Controllers\Doctor\Login\DoctorLoginController::class, 'logout'])->name('doctor.logout');
});

// Branch Authentication Routes
Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/branch', [App\Http\Controllers\Branch\Login\BranchLoginController::class, 'index'])->name('branch.login');
    Route::post('/branch/login-action', [App\Http\Controllers\Branch\Login\BranchLoginController::class, 'login'])->name('branch.login.post');
});

Route::group(['prefix' => 'branch', 'middleware' => ['prevent-back-history', 'is_branch']], function () {
    Route::get('/dashboard', function () {
        return view('Branch.Dashboard.index');
    })->name('branch.dashboard');
    Route::get('/logout', [App\Http\Controllers\Branch\Login\BranchLoginController::class, 'logout'])->name('branch.logout');
});

// Fallback Route
Route::fallback(function () {
    return redirect('/admin/404');
})->name('fallback');