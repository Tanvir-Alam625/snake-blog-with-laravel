<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\adminUserController;
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

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // user create routes 
    Route::get('/admin/user', [ adminUserController::class, 'create'])->name('user.create');
    Route::post('/admin/user', [ adminUserController::class, 'store'])->name('user.create');
    Route::get('/admin/user_delete/{id}', [ adminUserController::class, 'destroy'])->name('user.destroy');
    Route::get('/admin/profile/info', [ adminUserController::class, 'info'])->name('profile.info');
    Route::post('/admin/profile/info/{id}', [ adminUserController::class, 'update'])->name('profile.update');
    Route::post('/admin/profile/password/{id}', [ adminUserController::class, 'passwordChange'])->name('password.change');
});

require __DIR__.'/auth.php';
