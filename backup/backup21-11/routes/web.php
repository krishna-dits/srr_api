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
    // ======================================== Customer ==================================================



    // ======================================== Is Master ==================================================
    Route::group(['middleware' => ['permission:Is Master']], function () {
        Route::group(['middleware' => ['permission:Customer Add']], function () {
            Route::get('/is-master-add', [IsMasterController::class, 'is_master_Create'])->name('is-master-add');
            Route::post('/is-master-save', [IsMasterController::class, 'is_master_save'])->name('is-master-save');
        });
        Route::group(['middleware' => ['permission:Is Master List']], function () {
            Route::get('/is-master-list', [IsMasterController::class, 'is_master_list'])->name('is-master-list');
        });

        Route::group(['middleware' => ['permission:Is Master delete']], function () {
            Route::get('/is-master-delete/{id?}', [IsMasterController::class, 'is_master_delete'])->name('is-master-delete');
        });

        Route::group(['middleware' => ['permission:Is Master edit']], function () {
            Route::get('is-master-edit/{id?}', [IsMasterController::class, 'is_master_edit'])->name('is-master-edit');
            Route::post('is-master-update', [IsMasterController::class, 'is_master_update'])->name('is-master-update');
        });
    });
    // ======================================== Is Master ==================================================

    // ======================================== Size Master ==================================================
    Route::group(['middleware' => ['permission:Size Master']], function () {
        Route::group(['middleware' => ['permission:Size Master Add']], function () {
            Route::get('/size-master-add', [SizeMasterController::class, 'size_master_Create'])->name('size-master-add');
            Route::post('/size-master-save', [SizeMasterController::class, 'size_master_save'])->name('size-master-save');
            Route::post('/get-desire-by-is-master-type', [SizeMasterController::class, 'get_desire'])->name('get-desire-by-is-master-type');
        });
        Route::group(['middleware' => ['permission:Size Master List']], function () {
            Route::get('/size-master-list', [SizeMasterController::class, 'size_master_list'])->name('size-master-list');
        });

        Route::group(['middleware' => ['permission:Size Master delete']], function () {
            Route::get('/size-master-delete/{id?}', [SizeMasterController::class, 'size_master_delete'])->name('size-master-delete');
        });

        Route::group(['middleware' => ['permission:Size Master edit']], function () {
            Route::get('size-master-edit/{id?}', [SizeMasterController::class, 'size_master_edit'])->name('size-master-edit');
            Route::post('size-master-update', [SizeMasterController::class, 'size_master_update'])->name('size-master-update');
        });
    });
    // ======================================== Size Master ==================================================

    // ======================================== Thickness Master =============================================
    Route::group(['middleware' => ['permission:Thickness Master']], function () {
        Route::group(['middleware' => ['permission:Thickness Master Add']], function () {
            Route::get('/thickness-master-add', [ThicknessMasterController::class, 'thickness_master_Create'])->name('ThicknessMasterAdd');
            Route::post('/thickness-master-save', [ThicknessMasterController::class, 'thickness_master_save'])->name('ThicknessMasterSave');
        });
        Route::group(['middleware' => ['permission:Thickness Master List']], function () {
            Route::get('/thickness-master-list', [ThicknessMasterController::class, 'thickness_master_list'])->name('ThicknessMasterList');
        });

        Route::group(['middleware' => ['permission:Thickness Master delete']], function () {
            Route::get('/thickness-master-delete/{id?}', [ThicknessMasterController::class, 'thickness_master_delete'])->name('ThicknessMasterDelete');
        });

        Route::group(['middleware' => ['permission:Thickness Master edit']], function () {
            Route::get('thickness-master-edit/{id?}', [ThicknessMasterController::class, 'thickness_master_edit'])->name('ThicknessMasterEdit');
            Route::post('thickness-master-update', [ThicknessMasterController::class, 'thickness_master_update'])->name('ThicknessMasterUpdate');
        });
    });
    // ========================================  Thickness Master =============================================

    // ======================================== Grade Master ==================================================
    Route::group(['middleware' => ['permission:Grade Master']], function () {
        Route::group(['middleware' => ['permission:Grade Master Add']], function () {
            Route::get('/grade-master-add', [GradeMasterController::class, 'grade_master_Create'])->name('GradeMasterAdd');
            Route::post('/grade-master-save', [GradeMasterController::class, 'grade_master_save'])->name('GradeMasterSave');
        });
        Route::group(['middleware' => ['permission:Grade Master List']], function () {
            Route::get('/grade-master-list', [GradeMasterController::class, 'grade_master_list'])->name('GradeMasterList');
        });

        Route::group(['middleware' => ['permission:Grade Master delete']], function () {
            Route::get('/grade-master-delete/{id?}', [GradeMasterController::class, 'grade_master_delete'])->name('GradeMasterDelete');
        });

        Route::group(['middleware' => ['permission:Grade Master edit']], function () {
            Route::get('grade-master-edit/{id?}', [GradeMasterController::class, 'grade_master_edit'])->name('GradeMasterEdit');
            Route::post('grade-master-update', [GradeMasterController::class, 'grade_master_update'])->name('GradeMasterUpdate');
        });
    });
    // ======================================== Grade Master ==================================================

    // ======================================== Po/Do Master ==================================================
    Route::group(['middleware' => ['permission: PoDo Master']], function () {
        Route::group(['middleware' => ['permission:PoDo Master Add']], function () {
            Route::get('/podo-master-add', [PoDoMasterController::class, 'podo_master_Create'])->name('PoDoMasterAdd');
            Route::post('/podo-master-save', [PoDoMasterController::class, 'podo_master_save'])->name('PoDoMasterSave');
        });
        Route::group(['middleware' => ['permission:PoDo Master List']], function () {
            Route::get('/podo-master-list', [PoDoMasterController::class, 'podo_master_list'])->name('PoDoMasterList');
        });

        Route::group(['middleware' => ['permission:PoDo Master delete']], function () {
            Route::get('/podo-master-delete/{id?}', [PoDoMasterController::class, 'podo_master_delete'])->name('PoDoMasterDelete');
        });

        Route::group(['middleware' => ['permission:PoDo Master edit']], function () {
            Route::get('podo-master-edit/{id?}', [PoDoMasterController::class, 'podo_master_edit'])->name('PoDoMasterEdit');
            Route::post('podo-master-update', [PoDoMasterController::class, 'podo_master_update'])->name('PoDoMasterUpdate');
        });
    });
    // ========================================  Po/Do Master  ==================================================

    // ======================================== Max Min Master ==================================================
    Route::group(['middleware' => ['permission:MaxMinLimit']], function () {
        Route::group(['middleware' => ['permission:MaxMinLimit Add']], function () {
            Route::get('/max-min-limit-add', [MaxMinLimitController::class, 'max_min_limit_Create'])->name('MaxMinLimitAdd');
            Route::post('/max-min-limit-save', [MaxMinLimitController::class, 'max_min_limit_save'])->name('MaxMinLimitSave');
        });
        Route::group(['middleware' => ['permission:MaxMinLimit List']], function () {
            Route::get('/max-min-limit-list', [MaxMinLimitController::class, 'max_min_limit_list'])->name('MaxMinLimitList');
        });

        Route::group(['middleware' => ['permission:MaxMinLimit delete']], function () {
            Route::get('/max-min-limit-delete/{id?}', [MaxMinLimitController::class, 'max_min_limit_delete'])->name('MaxMinLimitDelete');
        });

        Route::group(['middleware' => ['permission:MaxMinLimit edit']], function () {
            Route::get('max-min-limit-edit/{id?}', [MaxMinLimitController::class, 'max_min_limit_edit'])->name('MaxMinLimitEdit');
            Route::post('max-min-limit-update', [MaxMinLimitController::class, 'max_min_limit_update'])->name('MaxMinLimitUpdate');
        });
    });
    // ======================================== Grade Master ==================================================
    // ======================================== Coil Master ==================================================
    Route::group(['middleware' => ['permission:Coil Master']], function () {
        Route::group(['middleware' => ['permission:Coil Master Add']], function () {
            Route::get('/coil-master-add', [CoilMasterController::class, 'coil_master_Create'])->name('CoilMasterAdd');
            Route::post('/coil-master-save', [CoilMasterController::class, 'coil_master_save'])->name('CoilMasterSave');
        });
        Route::group(['middleware' => ['permission:Coil Master List']], function () {
            Route::get('/coil-master-list', [CoilMasterController::class, 'coil_master_list'])->name('CoilMasterList');
        });

        Route::group(['middleware' => ['permission:Coil Master delete']], function () {
            Route::get('/coil-master-delete/{id?}', [CoilMasterController::class, 'coil_master_delete'])->name('CoilMasterDelete');
        });

        Route::group(['middleware' => ['permission:Coil Master edit']], function () {
            Route::get('coil-master-edit/{id?}', [CoilMasterController::class, 'coil_master_edit'])->name('CoilMasterEdit');
            Route::post('coil-master-update', [CoilMasterController::class, 'coil_master_update'])->name('CoilMasterUpdate');
        });
    });
    // ======================================== Grade Master ==================================================

    // ======================================== Batch Entry ==================================================
    Route::group(['middleware' => ['permission:Batch Entry']], function () {
        Route::group(['middleware' => ['permission:Batch Entry Add']], function () {
            Route::get('/batch-add', [BatchController::class, 'batch_Create'])->name('BatchAdd');
            Route::post('/batch-add-save', [BatchController::class, 'batch_save'])->name('BatchSave');
            Route::post('/get-month-and-year-by-date', [BatchController::class, 'get_month_and_year_by_date'])->name('get-month-and-year-by-date');


        });
        Route::group(['middleware' => ['permission:Batch Entry List']], function () {
            Route::get('/batch-list', [BatchController::class, 'batch_list'])->name('BatchList');
        });

        Route::group(['middleware' => ['permission:Batch Entry delete']], function () {
            Route::get('/batch-delete/{id?}', [BatchController::class, 'batch_delete'])->name('BatchDelete');
        });

        Route::group(['middleware' => ['permission:Batch Entry edit']], function () {
            Route::get('batch-edit/{id?}', [BatchController::class, 'batch_edit'])->name('BatchEdit');
            Route::post('batchr-update', [BatchController::class, 'batch_update'])->name('BatchUpdate');
        });
    });
    // ======================================== Grade Master ==================================================

    // ======================================== Tc Master ==================================================
    Route::group(['middleware' => ['permission:Tc Master']], function () {
        Route::group(['middleware' => ['permission:Tc Master Add']], function () {
            Route::get('/tc-master-add', [TcMasterController::class, 'tc_master_Create'])->name('TcMasterAdd');
            Route::get('/tc-master-edit-view/{id}', [TcMasterController::class, 'tc_master_Create_previous'])->name('TcMasterAdd_previous');
            
            Route::post('/tc-master-edit-view', [TcMasterController::class, 'tc_master_Create_update'])->name('TcMasterAdd_previous_update');
            Route::post('/tc-master-save', [TcMasterController::class, 'tc_master_save'])->name('TcMasterSave');
            Route::get('/tc-master-details-save/{id?}', [TcMasterController::class, 'tc_master_detail_save'])->name('TcMasterDetailsSave');
            Route::post('/getLotNos', [TcMasterController::class, 'getLotNos'])->name('getLotNos');
            Route::post('/get-grades', [TcMasterController::class, 'getGrades'])->name('getGrades');
            Route::post('/getBatchInfo', [TcMasterController::class, 'getBatchInfo'])->name('getBatchInfo');
            Route::post('/getHeatList', [TcMasterController::class, 'getHeatList'])->name('getHeatList');
            Route::post('/get-bend-flattening', [TcMasterController::class, 'getBendFlattening'])->name('getBendFlattening');
            Route::post('/Tcdetailsave', [TcMasterController::class, 'Tcdetailsave'])->name('Tcdetailsave');
            Route::post('/get-cml-no', [TcMasterController::class, 'get_cml_no'])->name('get-cml-no');
            Route::post('/get-hp-no', [TcMasterController::class, 'get_hp_no'])->name('get-hp-no');
            Route::post('/get-all-tc-details', [TcMasterController::class, 'get_all_tc_details'])->name('get-all-tc-details');
            Route::post('/get-all-coil-details', [TcMasterController::class, 'get_all_coil_details'])->name('get-all-coil-details');
            Route::post('/get-all-batch-details', [TcMasterController::class, 'get_all_batch_details'])->name('get-all-batch-details');
            Route::post('/get-all-is-master-details', [TcMasterController::class, 'get_all_is_master_details'])->name('get-all-is-master-details');
            Route::post('/get-coform-is-year', [TcMasterController::class, 'get_coform_is_year'])->name('get-coform-is-year');
            Route::post('/get-customer-id-no', [TcMasterController::class, 'get_customer_id_no'])->name('get-customer-id-no');
            Route::post('/get-size-by-is-master', [TcMasterController::class, 'get_size_by_is_master'])->name('get-size-by-is-master');
        });
        Route::group(['middleware' => ['permission:Tc Master List']], function () {
            Route::get('/tc-master-list', [TcMasterController::class, 'tc_master_list'])->name('TcMasterList');
        });
        Route::group(['middleware' => ['permission:Tc Master delete']], function () {
            Route::get('/tc-master-delete/{id?}', [TcMasterController::class, 'tc_master_delete'])->name('TcMasterDelete');
        });
        Route::group(['middleware' => ['permission:Tc Master Print']], function () {
            Route::get('/tc-master-print/{id?}', [TcMasterController::class, 'tc_master_print'])->name('TcMasterPrint');
        });
        Route::group(['middleware' => ['permission:Tc Master edit']], function () {
            Route::get('tc-master-edit/{id?}', [TcMasterController::class, 'tc_master_edit'])->name('TcMasterEdit');
            Route::post('TcdetailUpdate', [TcMasterController::class, 'TcdetailUpdate'])->name('TcdetailUpdate');
            Route::post('tc-master-update', [TcMasterController::class, 'tc_master_update'])->name('TcMasterUpdate');
        });
    });
});

// ======================================== Set Up =========================================


// ======================================== Tc Master ==================================================

Route::group(['middleware' => ['permission:Reports']], function () {
    Route::group(['middleware' => ['permission:Batch Report']], function () {
        Route::get('/batch-report', [ReportsController::class, 'batch_report'])->name('BatchReport');
        Route::post('/show-batch-report', [ReportsController::class, 'show_batch_report'])->name('ShowBatchReport');
    });

    Route::group(['middleware' => ['permission:Tc Report']], function () {
        Route::get('/tc-report', [ReportsController::class, 'tc_report'])->name('TcReport');
        Route::post('/show-tc-report', [ReportsController::class, 'show_tc_report'])->name('ShowTcReport');
    });
});

Route::post('/get-coil-data', [BatchController::class, 'getCoilData'])->name('get-heat-numbers');
Route::post('/get-sizes-by-is-name', [BatchController::class, 'getSizesByIsName'])->name('get-sizes-by-is-name');


// ======================================== Tc Master ==================================================