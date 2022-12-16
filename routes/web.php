<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\adminUserController;
use App\Http\Controllers\CategoryController;
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

Route::middleware('auth')->prefix('admin')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // user create routes 
    Route::get('/user', [ adminUserController::class, 'create'])->name('user.create')->middleware('RoleManagement');
    Route::post('/user', [ adminUserController::class, 'store'])->name('user.create')->middleware('RoleManagement');
    Route::get('/user_delete/{id}', [ adminUserController::class, 'destroy'])->name('user.destroy')->middleware('RoleManagement');
    Route::get('/profile/info', [ adminUserController::class, 'info'])->name('profile.info');
    Route::post('/profile/info/{id}', [ adminUserController::class, 'update'])->name('profile.update');
    Route::post('/profile/password/{id}', [ adminUserController::class, 'passwordChange'])->name('password.change');
    // categories Routes
    Route::resource('categories',CategoryController::class)->middleware('RoleManagement');
    Route::post('/categories/delete/{id}', [CategoryController::class, 'delete'])->middleware('RoleManagement')->name('category.force');
});

require __DIR__.'/auth.php';
