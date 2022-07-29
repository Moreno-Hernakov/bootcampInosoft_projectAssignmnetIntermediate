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
    Route::post('/create_task', [TaskController::class, 'createTask']);
    Route::post('/show_tasks', [TaskController::class, 'showTasks']);
    Route::post('/update_task', [TaskController::class, 'updateTask']);


    // NOTE: lanjutkan tugas assignment di routing baru dibawah ini
});