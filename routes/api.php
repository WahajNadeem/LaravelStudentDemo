<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

// Route::group(['middleware' => "auth:sanctum"], function () {

    Route::get('students/{id}', [StudentController::class, 'getStudentById']);

    Route::put('update-student/{id}', [StudentController::class, 'updateStudent']);

    Route::get('students', [StudentController::class, 'studentList']);

    Route::post('add-student', [StudentController::class, 'addStudent']);

    Route::delete('delete-student/{id}', [StudentController::class, 'deleteStudent']);

    Route::patch('update-student/{id}', [StudentController::class, 'updateStudentInfo']);

    Route::post('/student/{id}/upload', [StudentController::class, 'buploadFiles']);
// });



Route::post('/login', [UserController::class, 'login']);

Route::post('/signUp', [UserController::class, 'signUp']);
