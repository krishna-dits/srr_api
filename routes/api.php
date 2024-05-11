<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Master\ItemCategory\ItemCategoryApi;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\Master\ItemCategoryController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\TaskCategoryCon;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\LeaveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::get('test', function () {
//     return "API working successfully.";
// });



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH RELATED ROUTE



// LOGIN USER
Route::post('login', [AuthController::class, 'loginUser']);

// LOGOUT USER
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('user-data', [AuthController::class, 'user_data']);
    Route::post('update_user', [AuthController::class, 'update_user']);
    Route::get('forget_password', [AuthController::class, 'forget_password']);

    // TASK MANAGEMENT
    Route::post('create_task', [TaskController::class, 'create_task']);
    Route::post('update_task/{id}', [TaskController::class, 'update_task']);
    Route::post('get_task', [TaskController::class, 'get_task']);
    Route::post('get_task_by_id', [TaskController::class, 'get_task_by_id']);
    Route::post('get_task_for_user', [TaskController::class, 'get_task_for_user']);
    Route::get('task_status_update/{id}/{status}', [TaskController::class, 'task_status_update']);
    Route::post('task_arcrived', [TaskController::class, 'task_arcrived']);

    Route::get('get_task_category', [TaskCategoryCon::class, 'get_task_category']);
    Route::post('create_task_category', [TaskCategoryCon::class, 'create_task_category']);
    Route::post('update_task_category/{id}', [TaskCategoryCon::class, 'update_task_category']);

    Route::post('create_task_issue', [TaskCategoryCon::class, 'create_task_issue']);
    Route::get('resolve_task_issue/{id}', [TaskCategoryCon::class, 'resolve_task_issue']);
    Route::get('get_issue_for_admin', [TaskCategoryCon::class, 'get_issue_for_admin']);
    Route::get('get_issue_for_user/{user_id}', [TaskCategoryCon::class, 'get_issue_for_user']);
    Route::post('delete_task', [TaskController::class, 'delete_task']);



    //NOTES
    Route::get('getNotes', [NoteController::class, 'get_notes']);
    Route::get('getNotesById/{id}', [NoteController::class, 'getNotesById']);
    Route::post('saveNotes', [NoteController::class, 'save_notes']);
    Route::post('updateNotes', [NoteController::class, 'update_notes']);
    Route::get('deleteNotes/{id}', [NoteController::class, 'delete_notes']);

    //leaves
    Route::get('getLeaves', [LeaveController::class, 'get_leaves']);
    Route::post('saveLeaves', [LeaveController::class, 'save_leaves']);
    Route::post('updateLeaves', [LeaveController::class, 'update_leave']);
    Route::get('deleteLeaves/{id}', [LeaveController::class, 'delete_leave']);
    Route::get('updateStatus/{id}/{status}', [LeaveController::class, 'update_status']);
    Route::get('userWiseLeave', [LeaveController::class, 'user_wise_leave']);
    Route::get('user_wise_leave_with_id/{id}', [LeaveController::class, 'user_wise_leave_with_id']);


    // User data
    Route::get('get_user_list', [UserController::class, 'get_user_list']);




    //    //LEAVE TYPE
    //    Route::get('getLeaveType', [LeaveTypeController::class, 'get_leave_type']);
    //    Route::post('saveLeaveType', [LeaveTypeController::class, 'save_leave_type']);
    //    Route::post('updateLeaveType', [LeaveTypeController::class, 'update_leave_type']);
    //    Route::get('deleteLeaveType/{id}', [LeaveTypeController::class, 'delete_leave_type']);
    //
    //    //LEAVE ALLOCATIONS
    //    Route::get('getLeaveAllocation', [LeaveAllocationController::class, 'get_leave_allocation']);
    //    Route::post('saveLeaveAllocation', [LeaveAllocationController::class, 'save_leave_allocation']);
    //    Route::post('updateLeaveAllocation', [LeaveAllocationController::class, 'update_leave_allocation']);
    //    Route::get('deleteLeaveAllocation/{id}', [LeaveAllocationController::class, 'delete_leave_allocation']);
    //
    //    //APPLY LEAVE
    //    Route::get('getAppliedLeaves', [ApplyLeaveController::class, 'get_leaves']);
    //    Route::get('getAppliedLeavesByUser', [ApplyLeaveController::class, 'get_leave_by_user']);
    //    Route::post('applyLeaves', [ApplyLeaveController::class, 'save_leaves']);
    //    Route::post('updateLeaves', [ApplyLeaveController::class, 'update_leaves']);
    //    Route::get('deleteLeaves/{id}', [ApplyLeaveController::class, 'delete_leaves']);
});


// Route::group(['middleware' => ['auth:sanctum','permission:add item categories']], function() {

//     Route::get('/itemCategoryViewApi',[ItemCategoryApi::class, 'itemCategoryViewApi'])->name('itemCategoryViewApi');
//     Route::get('/itemCategoryViewByIdApi/{id}',[ItemCategoryApi::class, 'itemCategoryViewByIdApi'])->name('itemCategoryViewByIdApi');

// });

// // ITEM CATEGORY ADD ROUTES
// Route::group(['middleware' => ['auth:sanctum','permission:add item categories']], function () {

//     Route::post('/itemCategoryAddAction',[ItemCategoryApi::class, 'itemCategoryAddAction'])->name('itemCategoryAddAction');

// });
