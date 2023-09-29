<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\RequestBookController;
use App\Http\Controllers\UserController;
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
    $route->get('/', [AuthController::class, 'index'])->name('auth.index');
    $route->post('/login', [AuthController::class, 'login'])->name('auth.login');
    $route->get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
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

    $route->group(['prefix' => 'user', 'middleware' => ['check_role:admin']], function ($route) {
        $route->get('/index', [AdminController::class, 'index'])->name('admin.user.index');
        $route->post('/store', [AdminController::class, 'store'])->name('admin.user.store');
        $route->post('/update', [AdminController::class, 'update'])->name('admin.user.update');
        $route->post('/delete', [AdminController::class, 'delete'])->name('admin.user.delete');
    });

    $route->group(['prefix' => 'requested_books', 'middleware' => ['check_role:admin']], function ($route) {
        $route->get('/index', [RequestBookController::class, 'index'])->name('admin.requestedbook.index');
        $route->post('/update', [RequestBookController::class, 'approveOrDisapprove'])->name('admin.requestedbooks.approveOrDisapprove');
    });
});


Route::group(['prefix' => 'user'], function ($route) {
    $route->group(['prefix' => 'book', 'middleware' => ['check_role:user', 'check_auth']], function ($route) {
        $route->get('/', [UserController::class, 'index'])->name('user.book.index');
        $route->post('/borrow', [UserController::class, 'borrow'])->name('user.book.borrow');
        $route->post('/addToFavorite', [UserController::class, 'addToFavorite'])->name('user.book.addToFavorite');
    });

    $route->group(['prefix' => 'favorites', 'middleware' => ['check_role:user', 'check_auth']], function ($route) {
        $route->get('/', [FavoritesController::class, 'index'])->name('user.favorites.index');
    });

    $route->group(['prefix' => 'requested_books', 'middleware' => ['check_role:user', 'check_auth']], function ($route) {
        $route->get('/user_index', [RequestBookController::class, 'user_index'])->name('user.requestbook.user_index');
        $route->post('/requestABook', [RequestBookController::class, 'requestABook'])->name('user.requestbook.requestABook');
    });
});

Route::get('/', function () {
    return redirect()->route('auth.index');
});


// ->middleware('check_auth');