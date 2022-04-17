<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LoginController;

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
Route::get('/get_tasks', [TaskController::class, 'get_tasks']);
Route::get('/get_edit_task/{id}', [TaskController::class, 'get_edit_task']);
Route::get('/get_tasks_complete', [TaskController::class, 'get_tasks_complete']);
Route::get('/delete_all_task_complete', [TaskController::class, 'delete_all_task_complete']);
Route::get('/delete_task/{id}', [TaskController::class, 'delete_task']);
Route::get('/complete_task/{id}', [TaskController::class, 'complete_task']);
Route::post('/add_task', [TaskController::class, 'add_task']);
Route::post('/update_edit_task', [TaskController::class, 'update_edit_task']);
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->middleware('auth:api');;
