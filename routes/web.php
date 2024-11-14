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
    ->group(function() {
        Route::get('', 'index')->name('home');
        Route::get('create', 'create')->name('create');
        Route::post('create', 'store')->name('store');
        Route::get('edit/{task}', 'edit')->name('edit');
        Route::post('edit/{task}', 'update')->name('update');
        Route::get('delete/{task}', 'destroy')->name('destroy');
        Route::get('complete/{task}', 'complete')->name('complete');
        Route::post('attach/{task}', 'attach')->name('attach');
    });

Route::middleware(['auth', 'verified'])
    ->name('tags.')
    ->controller(TagController::class)
    ->group(function() {
        Route::get('tags', 'index')->name('home');
        Route::get('tags/create', 'create')->name('create');
        Route::post('tags/create', 'store')->name('store');
        Route::get('tags/edit/{tag}', 'edit')->name('edit');
        Route::post('tags/edit/{tag}', 'update')->name('update');
        Route::get('tags/delete/{tag}', 'destroy')->name('destroy');
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

require __DIR__.'/auth.php';
