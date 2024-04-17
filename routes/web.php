<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ExportDataGroupController;
use App\Http\Controllers\Auth\RegisteredUserController;

require __DIR__ . '/auth.php';


Route::group(['middleware' => ['auth']], function () {
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
    Route::patch('permission/{id}', [PermissionController::class, 'update'])->name('permission.update');

    // Flag View
    Route::post('user-config/update', [DashboardController::class, 'configUpdate'])->name('user.configUpdate');
    Route::post('user/change/password', [DashboardController::class, 'changePassword'])->name('user.changePassword');

    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest');

    // Category CRUD
    Route::resource('categories', CategoryController::class);

    // Tags CRUD
    Route::resource('tags', TagController::class);

    Route::controller(ListingController::class)->name('listings.')->prefix('listings/')->group(function () {
        // Listing CRUD
        Route::get('view', 'index')->name('index');
        Route::post('store', 'store')->name('store');
        Route::get('{id}/show', 'show')->name('show');
        Route::get('{id}/edit', 'edit')->name('edit');
        Route::get('create', 'create')->name('create');
        Route::post('filter', 'filter')->name('filter');
        Route::patch('{id}/update', 'update')->name('update');
        Route::delete('{id}/delete', 'destroy')->name('destroy');

        // Import/Export Logs
        Route::get('user/import/export/logs', 'importExportLogs')->name('user.import.export.logs');

        // Listings Import/Export Operations
        Route::get('data/export', 'export')->name('data.export');   // Export page view
        Route::get('data/import', 'import')->name('data.import');   // Import page view
        Route::get('import/columns', 'getColumns')->name('import.columns');
        Route::post('filter/export', 'exportFilter')->name('export.filtered');
        Route::get('import/data/status', 'getStatus')->name('import.data.status');
        Route::get('data/handel/export', 'handelExport')->name('data.handel.export');
        Route::post('data/handel/import', 'handelImport')->name('data.handel.import');
    });

    // Export Data Group
    Route::controller(ExportDataGroupController::class)->prefix('listing/export/')->name('listing.export.')->group(function () {
        Route::get('groups', 'index')->name('group.index');
        Route::get('groups/create', 'create')->name('group.create');
        Route::post('groups/store', 'store')->name('group.store');
        Route::get('groups/{id}/edit', 'edit')->name('group.edit');
        Route::patch('groups/{id}/update', 'update')->name('group.update');
        Route::delete('groups/{id}/delete', 'destroy')->name('group.destroy');
    });

    // Custom Fields Operations
    Route::controller(FieldController::class)->name('field.')->group(function () {
        Route::get('fields', 'index')->name('index');
        Route::get('field/create', 'create')->name('create');
        Route::post('fields/store', 'store')->name('store');
    });
});


// Redirect to dashboard on 404
Route::fallback(function () {
    return redirect()->route('dashboard')->with('error', 'An error occurred. Please try again.');
});
