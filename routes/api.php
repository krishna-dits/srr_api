<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\Master\ItemCategory\ItemCategoryApi;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\Master\ItemCategoryController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NoteController;
use App\Http\Controllers\API\LeaveTypeController;
use App\Http\Controllers\API\LeaveAllocationController;
use App\Http\Controllers\API\ApplyLeaveController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// AUTH RELATED ROUTE

// LOGIN USER
Route::post('/login', [AuthController::class, 'loginUser']);

// LOGOUT USER
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user-data', [AuthController::class, 'user_data']);

    // TASK MANAGEMENT
    Route::prefix('task')->group(function () {
        Route::post('create', [TaskController::class, 'create']);
        Route::post('update/{id}', [TaskController::class, 'update']);
        Route::post('get', [TaskController::class, 'get']);
    });


    //NOTES
    Route::get('getNotes', [NoteController::class, 'get_notes']);
    Route::post('saveNotes', [NoteController::class, 'save_notes']);
    Route::post('updateNotes', [NoteController::class, 'update_notes']);
    Route::get('deleteNotes/{id}', [NoteController::class, 'delete_notes']);

    //LEAVE TYPE
    Route::get('getLeaveType', [LeaveTypeController::class, 'get_leave_type']);
    Route::post('saveLeaveType', [LeaveTypeController::class, 'save_leave_type']);
    Route::post('updateLeaveType', [LeaveTypeController::class, 'update_leave_type']);
    Route::get('deleteLeaveType/{id}', [LeaveTypeController::class, 'delete_leave_type']);

    //LEAVE ALLOCATIONS
    Route::get('getLeaveAllocation', [LeaveAllocationController::class, 'get_leave_allocation']);
    Route::post('saveLeaveAllocation', [LeaveAllocationController::class, 'save_leave_allocation']);
    Route::post('updateLeaveAllocation', [LeaveAllocationController::class, 'update_leave_allocation']);
    Route::get('deleteLeaveAllocation/{id}', [LeaveAllocationController::class, 'delete_leave_allocation']);

    //APPLY LEAVE
    Route::get('getAppliedLeaves', [ApplyLeaveController::class, 'get_leaves']);
    Route::get('getAppliedLeavesByUser', [ApplyLeaveController::class, 'get_leave_by_user']);
    Route::post('applyLeaves', [ApplyLeaveController::class, 'save_leaves']);
    Route::post('updateLeaves', [ApplyLeaveController::class, 'update_leaves']);
    Route::get('deleteLeaves/{id}', [ApplyLeaveController::class, 'delete_leaves']);


});


// Route::group(['middleware' => ['auth:sanctum','permission:add item categories']], function() {

//     Route::get('/itemCategoryViewApi',[ItemCategoryApi::class, 'itemCategoryViewApi'])->name('itemCategoryViewApi');
//     Route::get('/itemCategoryViewByIdApi/{id}',[ItemCategoryApi::class, 'itemCategoryViewByIdApi'])->name('itemCategoryViewByIdApi');

// });

// // ITEM CATEGORY ADD ROUTES
// Route::group(['middleware' => ['auth:sanctum','permission:add item categories']], function () {

//     Route::post('/itemCategoryAddAction',[ItemCategoryApi::class, 'itemCategoryAddAction'])->name('itemCategoryAddAction');

// });
