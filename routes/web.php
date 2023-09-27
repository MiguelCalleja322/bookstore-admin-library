<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\User\UserController;
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


Route::group(['prefix' => 'auth'], function ($route) {
    $route->get('/', [AuthController::class, 'index'])->name('auth.index')->middleware('check_auth');
    $route->post('/login', [AuthController::class, 'login'])->name('auth.login');
    $route->group(['middleware' => ['auth']], function($route) {
        $route->post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });
});

Route::group(['prefix' => 'admin'], function ($route) {
    $route->group(['prefix' => 'book', 'middleware' => ['check_role:admin']], function ($route) {
        $route->get('/', [BookController::class, 'index'])->name('admin.book.index');
        $route->post('/store', [BookController::class, 'store'])->name('admin.book.store');
        $route->post('/update', [BookController::class, 'update'])->name('admin.book.update');
        $route->post('/delete', [BookController::class, 'delete'])->name('admin.book.delete');
        $route->post('/import', [BookController::class, 'import'])->name('admin.book.import');
        $route->get('/export', [BookController::class, 'export'])->name('admin.book.export');
    });
});

Route::get('/', function () {
    return redirect('/auth');
})->middleware('check_auth');
