<?php

use App\Http\Controllers\FileController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'authenticate']);

Route::middleware('auth:sanctum')->post('store', [FileController::class, 'store'])->name('store');

Route::controller(GradeController::class)->group(function(){
    Route::get('grades/show/{grade}','show')->name('grades.show');
    Route::get('grades/grades','grades')->name('grades.grades');
    Route::post('grades/create','create')->name('grades.create');
    Route::put('grades/update/{grade}','update')->name('grades.update');
    Route::delete('grades/delete/{grade}','delete')->name('grades.delete');
});

Route::controller(UserController::class)->group(function(){
    Route::get('users/show/{user}','show')->name('users.show');
    Route::get('users/users','users')->name('users.users');
    Route::post('users/create','create')->name('users.create');
    Route::put('users/update/{user}','update')->name('users.update');
    Route::delete('users/delete/{user}','delete')->name('users.delete');
});

Route::controller(SectionController::class)->group(function(){
    Route::get('sections/show/{section}','show')->name('sections.show');
    Route::get('sections/sections','sections')->name('sections.sections');
    Route::post('sections/create','create')->name('sections.create');
    Route::put('sections/update/{section}','update')->name('sections.update');
    Route::delete('sections/delete/{section}','delete')->name('sections.delete');
});

Route::controller(SubjectController::class)->group(function(){
    Route::get('subjects/show/{subject}','show')->name('subjects.show');
    Route::get('subjects/subjects','subjects')->name('subjects.subjects');
    Route::post('subjects/create','create')->name('subjects.create');
    Route::put('subjects/update/{subject}','update')->name('subjects.update');
    Route::delete('subjects/delete/{subject}','delete')->name('subjects.delete');
});

