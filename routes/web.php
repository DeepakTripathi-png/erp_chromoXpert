<?php

// Start Common Controllers Needed For All Projects
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Admin\Login\LoginController;
use App\Http\Controllers\Admin\Login\ForgotPasswordController;
use App\Http\Controllers\Admin\Settings\GeneralSettings;
use App\Http\Controllers\Admin\Settings\VisualSettings;
use App\Http\Controllers\Admin\SystemUsers\RolesPrivilegesController;
use App\Http\Controllers\Admin\SystemUsers\SystemUserController;
use App\Http\Controllers\Admin\NotFoundController\NotFoundController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
// End Common Controllers Needed For All Project

// Project Controller Start Here

// Project Controller Ends Here

// Start Common Routes For The Projects
Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    return 'storage linked';
});
Route::get('clear', function () {
    \Artisan::call('route:clear');
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    return 'clear';
});

Route::group(['middleware' => 'prevent-back-history'], function () {
    Route::get('/admin', [LoginController::class, 'index']);
});
Route::post('login-action', [LoginController::class, 'admin_login'])->name('login');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
Route::get('reset-password', function(){ return abort(404); });
// End Common Routes For The Projects


// Start FrontEnd Routes

Route::get('/', function () {
    return redirect('/admin');
});

// *
// *----------- CODE HERE  -------------
// *

// End Frontend Routes


// Start Backend Routes
Route::group(['prefix' => 'admin', 'middleware' => ['prevent-back-history', 'is_admin']], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Start Backend Common Routes For The Projects

    Route::controller(GeneralSettings::class)->group(function () {
        Route::get('general-setting', 'index');
        Route::post('general-settings-store', 'store')->name('geraral.settings.store');
    });

    Route::controller(VisualSettings::class)->group(function () {
        Route::get('visual-setting', 'index');
        Route::post('visual-settings-store', 'store')->name('visual.settings.store');
    });

    Route::controller(RolesPrivilegesController::class)->group(function () {
        Route::get('roles-privileges','index');
        Route::get('roles-privileges/add','create');
        Route::post('roles-privileges/store','store')->name('roles-previllages.store');
        Route::get('roles-privileges/data-table','data_table');
        Route::get('roles-privileges/edit/{id}','edit');
        Route::get('roles-privileges/check-role-exist','check_role_exist');
    });

    Route::controller(SystemUserController::class)->group(function () {
        Route::get('system-user','index');
        Route::get('system-user/add','create');
        Route::post('system-user/store','store')->name('system-user.store');
        Route::get('system-user/data-table','data_table');
        Route::get('system-user/edit/{id}','edit');
        Route::get('system-user/check-user-exist','check_user_exist');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('change-password', 'view_change_password');
        Route::post('change-password', 'change_password');
        Route::get('logout', 'logout');
    });

    Route::controller(BaseController::class)->group(function () {
        Route::get('sub-category-list', 'subCategoryList');
        Route::get('common-delete', 'delete');
        Route::post('change-status', 'status')->name('change-status');
    });
    // End Backend Common Routes For The Projects

    route::get('/404', [NotFoundController::class, 'index']);
});
//End Backend Routes

Route::fallback(function () {
    return redirect('admin/404');
});
