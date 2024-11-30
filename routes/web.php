<?php

    use App\Http\Controllers\HomeController;
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
    ->get('', [HomeController::class, 'index'])
    ->name('home');

Route::middleware(['auth', 'verified'])
    ->name('tasks.')
    ->controller(TaskController::class)
    ->group(function() {
        Route::get('task/create', 'create')->name('create');
        Route::post('task/create', 'store')->name('store');
        Route::get('task/edit/{task}', 'edit')->name('edit');
        Route::post('task/edit/{task}', 'update')->name('update');
        Route::get('task/delete/{task}', 'destroy')->name('destroy');
        Route::get('task/complete/{task}', 'complete')->name('complete');
        Route::get('task/{task}/tags/delete/{tag}', [TaskController::class, 'removeTag'])->name('tags.destroy');
    });

Route::middleware(['auth', 'verified'])
    ->name('tags.')
    ->controller(TagController::class)
    ->group(function() {
        Route::get('tag/create', 'create')->name('create');
        Route::post('tag/create', 'store')->name('store');
        Route::get('tag/edit/{tag}', 'edit')->name('edit');
        Route::post('tag/edit/{tag}', 'update')->name('update');
        Route::get('tag/delete/{tag}', 'destroy')->name('destroy');
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
