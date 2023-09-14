<?php

use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\SportEventController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return redirect("/login");
});

Auth::routes();

Route::resource('organizers', OrganizerController::class);
Route::resource('sport-events', SportEventController::class);
Route::resource('users', UserController::class);

Route::get('/users/{users}/change-password', [UserController::class, 'showChangePassword'])->name("users.change-password.show");
Route::put('/users/{users}/change-password', [UserController::class, 'updateChangePassword'])->name("users.change-password.update");

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
