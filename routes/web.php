<?php

use App\Http\Controllers\BatchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\Permission\PermissionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GradeMasterController;
use App\Http\Controllers\IsMasterController;
use App\Http\Controllers\SizeMasterController;
use App\Http\Controllers\PoDoMasterController;
use App\Http\Controllers\ThicknessMasterController;
use App\Http\Controllers\MaxMinLimitController;
use App\Http\Controllers\CoilMasterController;
use App\Http\Controllers\TcMasterController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Task\CategoryController;
use App\Http\Controllers\Task\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/dashboard', function () {
//     return view('appPages/dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'dashboard',])->middleware(['auth'])->name('dashboard');


require __DIR__ . '/auth.php';

// USER BASED PERMISSION RELATED ROUTES


Route::group(['middleware' => ['permission:asign userBasedPermission']], function () {
    Route::get('/user-permissionAsign-list', [PermissionController::class, 'userPermissionAsignList',])->middleware(['auth'])->name('userPermissionAsignList');
    Route::get('/permission-asign-to-user/{role}', [PermissionController::class, 'PermissionAsignToUser'])->name('PermissionAsignToUser');
    Route::post('/asign-permission-to-user', [PermissionController::class, 'PermissionAsignToUserAction'])->name('PermissionAsignToUserAction');
});


// ROLE BASED PERMISSION RELATED ROUTES
Route::group(['middleware' => ['permission:asign roleBasedPermission']], function () {

    Route::get('/permission-asign/{role}', [PermissionController::class, 'PermissionAsign'])->name('PermissionAsign');
    Route::post('/asign-permission', [PermissionController::class, 'asignPermission'])->name('asignPermission');
});

//================================ROLE=============================
// VIEW ROLE
Route::group(['middleware' => ['permission:view role']], function () {
    Route::get('/role-list', [RoleController::class, 'index'])->name('roleList');
});

// ADD ROLE
Route::group(['middleware' => ['permission:add role']], function () {
    Route::post('/add-role', [RoleController::class, 'addRole'])->name('addRole');
});
// DELETE ROLE
Route::group(['middleware' => ['permission:delete role']], function () {
    Route::post('/delete-role', [RoleController::class, 'deleteRole'])->name('deleteRole');
});
// EDIT ROLE
Route::group(['middleware' => ['permission:edit role']], function () {

    Route::get('/edit-role/{id}', [RoleController::class, 'editRole'])->name('editRole');
    Route::post('/edit-role-action', [RoleController::class, 'editRoleAction'])->name('editRoleAction');
});
//================================ROLE=============================

// ROLE ASIGNMENT TO USER RELATED ROUTES

Route::group(['middleware' => ['permission:asign roleToUser|revoke roleToUser']], function () {
    Route::get('/asign-role', [RoleController::class, 'asignRole'])->name('asignRole');
});

Route::group(['middleware' => ['permission:asign roleToUser']], function () {
    Route::post('/asign-role-action', [RoleController::class, 'asignRoleAction'])->name('asignRoleAction');
});

// ROLE REVOKE TO USER RELATED ROUTES
Route::group(['middleware' => ['permission:revoke roleToUser']], function () {
    Route::post('/revoke-role-action', [RoleController::class, 'revokeRoleAction'])->name('revokeRoleAction');
    Route::post('/usr-role-check', [RoleController::class, 'getRole'])->name('getRole');
});


//====================== PERMISSION =====================================
Route::group(['middleware' => ['permission:view permission']], function () {

    Route::get('/permission-list', [PermissionController::class, 'index'])->name('PermissionList');
});
// DELETE PERMISSION
Route::group(['middleware' => ['permission:delete permission']], function () {

    Route::post('/delete-permission', [PermissionController::class, 'deletePermission'])->name('deletePermission');
});
// ADD PERMISSION
Route::group(['middleware' => ['permission:add permission']], function () {

    Route::post('/add-permission', [PermissionController::class, 'addPermission'])->name('addPermission');
});
// EDIT PERMISSION
Route::group(['middleware' => ['permission:edit permission']], function () {

    Route::get('/permission-edit/{id}', [PermissionController::class, 'editPermission'])->name('permissionEdit');
    Route::post('/permission-edit-action', [PermissionController::class, 'editPermissionAction'])->name('permissionEditAction');
});
//====================== PERMISSION =====================================


//=========================== ITEM CATEGORY (not uused) ===========================


// ======================================== User ==================================================
Route::group(['middleware' => ['permission:User']], function () {
    Route::group(['middleware' => ['permission:User Add']], function () {
        Route::get('/User-add', [UserController::class, 'UserCreate'])->name('UserCreate');
        Route::post('/UserCreateAction', [UserController::class, 'UserCreateAction'])->name('UserCreateAction');
    });
    Route::group(['middleware' => ['permission:User List']], function () {
        Route::get('/user-list', [UserController::class, 'userlist'])->name('user-list');
    });
    Route::group(['middleware' => ['permission:user profile']], function () {
        Route::get('/user-profile/{id?}', [UserController::class, 'userprofile'])->name('user-profile');
    });
    Route::group(['middleware' => ['permission:user delete']], function () {
        Route::get('/user-delete/{id?}', [UserController::class, 'user_delete'])->name('user-delete');
    });
    Route::group(['middleware' => ['permission:user active deactive']], function () {
        Route::get('/user-enable-disable/{id?}', [UserController::class, 'user_enable_disable'])->name('user-enable-disable');
    });
    Route::group(['middleware' => ['permission:Change Password']], function () {
        Route::get('change-password', [UserController::class, 'change_password'])->name('change-password');
        Route::post('save-change-password', [UserController::class, 'save_change_password'])->name('save-change-password');
    });
    Route::group(['middleware' => ['permission:user edit']], function () {
        Route::get('user-edit/{id?}', [UserController::class, 'user_edit'])->name('user-edit');
        Route::post('user-update', [UserController::class, 'user_update'])->name('user-update');
    });
});
// ======================================== User ==================================================


// ======================================== Set Up =========================================
Route::group(['middleware' => ['permission:Set Up']], function () {

    // ====================== General Setting ==================
    Route::group(['middleware' => ['permission:General Setting']], function () {
        Route::get('general-setting-details', [SettingController::class, 'general_setting_details'])->name('general_setting_details');
        Route::post('save-general-setting', [SettingController::class, 'save_general_setting'])->name('save-general-setting');
    });
    // ====================== General Setting ==================

    // ======================================== Customer ==================================================
    Route::group(['middleware' => ['permission:Customer']], function () {
        Route::group(['middleware' => ['permission:Customer Add']], function () {
            Route::get('/Customer-add', [CustomerController::class, 'CustomerCreate'])->name('Customer-add');
            Route::post('/CustomerCreateAction', [CustomerController::class, 'CustomerCreateAction'])->name('CustomerCreateAction');
        });
        Route::group(['middleware' => ['permission:Customer List']], function () {
            Route::get('/Customer-list', [CustomerController::class, 'Customerlist'])->name('Customer-list');
        });

        Route::group(['middleware' => ['permission:Customer delete']], function () {
            Route::get('/Customer-delete/{id?}', [CustomerController::class, 'Customer_delete'])->name('Customer-delete');
        });

        Route::group(['middleware' => ['permission:Customer edit']], function () {
            Route::get('Customer-edit/{id?}', [CustomerController::class, 'Customer_edit'])->name('Customer-edit');
            Route::post('Customer-update', [CustomerController::class, 'Customer_update'])->name('Customer-update');
        });
    });

    Route::match(['get', 'post'], 'task-category/{id?}', [CategoryController::class, 'index'])->middleware([])->name('category');

    Route::get('delete-category/{id?}', [CustomerController::class, 'delete_category'])->name('delete_category');
});


Route::prefix('task')->group(function () {
    Route::match(['get', 'post'], 'create', [TaskController::class, 'create_task'])->name('create_task');
    Route::get('list', [TaskController::class, 'task_list'])->name('task_list');
});

// Route::middleware([])->group(function () {
//     Route::match(['get', 'post'], 'add-task', [])
// });
