<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified'])
    ->name('tasks.')
    ->controller(TaskController::class)
    ->group(function () {
        Route::get('', 'index')->name('home');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{task}', 'edit')->name('edit');
        Route::put('edit/{task}', 'update')->name('update');
        Route::get('delete/{task}', 'destroy')->name('destroy');
        Route::get('complete/{task}', 'complete')->name('complete');
    });

Route::middleware(['auth', 'verified'])
    ->prefix('tags')
    ->name('tags.')
    ->controller(TagController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{tag}', 'edit')->name('edit');
        Route::put('edit/{tag}', 'update')->name('update');
        Route::delete('delete/{tag}', 'destroy')->name('destroy');
    });


Route::middleware('auth')
    ->prefix('profile')
    ->name('profile.')
    ->controller(ProfileController::class)
    ->group(function () {
        Route::get('', 'edit')->name('edit');
        Route::patch('', 'update')->name('update');
        Route::delete('', 'destroy')->name('destroy');
    });

require __DIR__ . '/auth.php';
