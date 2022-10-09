<?php

use App\Http\Controller\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('task')->group(function() {
    Route::controller(TaskController::class)->group(function () {
          // tasks route
        Route::get('/show_tasks', 'showTasks');
        Route::post('/create_task', 'createTask');
        Route::put('/update_task', 'updateTask');
        Route::delete('/delete_task/{id}', 'deleteTask');
        Route::put('/assign_task', 'assignTask');
        Route::put('/unassign_task', 'unassignTask');

        // subtask route
        Route::put('/create_subtask', 'createSubtask');
        Route::delete('/delete_subtask/{task_id}/{subtask_id}', 'deleteSubtask');
    });
});