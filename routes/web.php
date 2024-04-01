<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\FieldController;

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['role:admin']], function () {
    Route::resource('user', UserController::class);
    Route::delete('user/{id}/force-delete', [UserController::class, 'forceDelete'])->name('user.forceDelete');
    Route::post('user/assign-role', [UserController::class, 'assignRole'])->name('user.assignrole');
    Route::post('user/revoke-role', [UserController::class, 'revokeRole'])->name('user.revokerole');

    // Role Routes
    Route::get('roles', [RoleController::class, 'index'])->name('role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::patch('role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::post('role/fetchPermission', [RoleController::class, 'fetchPermission'])->name('role.fetchPermission');

    // Permission Routes
    Route::get('permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('permission/create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('permission/{id}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::get('performance/report/view', [DashboardController::class, 'kpiReportView'])->name('employee.kpiView');
    Route::patch('permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('earned/badges', [DashboardController::class, 'assignedBadges'])->name('assignedBadges.show');
    Route::get('badge/{id}/terms-and-conditions', [DashboardController::class, 'badgeTermsAndConditions'])->name('badge.termsAndConditions');
    Route::get('salary-display', [DashboardController::class, 'salaryDisplay'])->name('salary.display');
    Route::get('salary/{id}/download', [DashboardController::class, 'downloadSalaryPDF'])->name('salary.downloadPdf');
    Route::get('salary/{id}/print', [DashboardController::class, 'printSalaryPdf'])->name('salary.printPdf');

    // Flag View
    Route::get('flags/earned', [DashboardController::class, 'flagEarned'])->name('flag.earned');
    Route::post('user-config/update', [DashboardController::class, 'configUpdate'])->name('user.configUpdate');
    Route::post('user/change/password', [DashboardController::class, 'changePassword'])->name('user.changePassword');
    Route::get('asset/assigned', [DashboardController::class, 'assignedAssets'])->name('assignedAssets');
    Route::post('asset/consumed', [DashboardController::class, 'markConsumed'])->name('markAssetConsumed');

    // Guideline Routes
    Route::get('guidelines', [DashboardController::class, 'guideline'])->name('guideline.index');
    Route::get('guideline/{slug}', [DashboardController::class, 'viewGuidelines'])->name('guideline.view');
    Route::get('assignedBadge/{id}', [DashboardController::class, 'assignedBadges'])->name('assignedBadge.view');

    Route::get('/activity/logs', [DashboardController::class, 'activityLog'])->name('activityLog');
    Route::get('notice/view', [DashboardController::class, 'viewNotice'])->name('notice.show');
    Route::get('reminders', [DashboardController::class, 'salesReminder'])->name('reminder.all');
    Route::get('sales/report', [DashboardController::class, 'salesReport'])->name('sales.report');
    Route::post('sales/report/filter', [DashboardController::class, 'filterSalesReport'])->name('sales.filterReport');
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');
    // Category CRUD
    Route::resource('categories', CategoryController::class);
    // Tags CRUD
    Route::resource('tags', TagController::class);
    // Listing CRUD
    Route::resource('listings', ListingController::class);
    Route::get('listings/data/export', [ListingController::class, 'export'])->name('listings.data.export');
    Route::post('listings/data/handel/export', [ListingController::class, 'handelExport'])->name('listings.data.handel.export');
    Route::get('listings/data/import', [ListingController::class, 'import'])->name('listings.data.import');
    Route::post('listings/filter', [ListingController::class, 'filter'])->name('listings.filter');
    Route::post('listings/filter/export', [ListingController::class, 'exportFilter'])->name('listings.export.filtered');
    Route::post('listings/data/handel/import', [ListingController::class, 'handelImport'])->name('listings.data.handel.import');
    Route::get('user/import/export/logs', [ListingController::class, 'importExportLogs'])->name('user.import.export.logs');

    Route::controller(FieldController::class)->name('field.')->group(function() {
        Route::get('fields', 'index')->name('index');
        Route::get('field/create', 'create')->name('create');
        Route::post('fields/store', 'store')->name('store');
    });
});


// Redirect to dashboard on 404
Route::fallback(function () {
    return redirect()->route('dashboard')->with('error', 'An error occurred. Please try again.');
});
