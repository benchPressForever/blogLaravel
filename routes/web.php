<?php

use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminPostsController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
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

Route::view('/', 'index')->name('home');

Route::get('/users/{user}', [UsersController::class,'show'])->name('users.show');



Route::name('posts.')
    ->prefix('posts')
    ->group(function () {
        Route::get('/{post}', [PostsController::class, 'show'])->where('id', '[0-9]+')->name('show');
        Route::get('/', [PostsController::class, 'index'])->name('index');
        Route::post('/{post}/add/like', [PostsController::class, 'addLike'])->name('like.add');
    });




Route::name('admin.')
    ->middleware(['auth', 'is_admin'])
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/users', [AdminController::class, 'posts'])->name('users');
        Route::name('posts.')
            ->prefix('posts')
            ->group(function () {
                Route::get('/', [AdminPostsController::class, 'index'])->name('index');
                Route::get('/create', [AdminPostsController::class, 'create'])->name('create');
                Route::get('/delete/{post}', [AdminPostsController::class, 'delete'])->name('delete');
                Route::post('/store', [AdminPostsController::class, 'store'])->name('store');
                Route::put('/{post}', [AdminPostsController::class, 'update'])->name('update');
                Route::get('/{post}/edit', [AdminPostsController::class, 'edit'])->name('edit');
            });
        Route::name('categories.')
            ->prefix('categories')
            ->group(function () {
                Route::get('/', [AdminCategoriesController::class, 'index'])->name('index');
                Route::get('/create', [AdminCategoriesController::class, 'create'])->name('create');
                Route::post('/store', [AdminCategoriesController::class, 'store'])->name('store');
                Route::put('/{category}', [AdminCategoriesController::class, 'update'])->name('update');
                Route::get('/{category}/edit', [AdminCategoriesController::class, 'edit'])->name('edit');
                Route::get('/delete/{category}', [AdminCategoriesController::class, 'delete'])->name('delete');
                Route::get('/show/{id}', [AdminCategoriesController::class, 'show'])->name('show');
            });
        Route::name('users.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', [AdminUsersController::class, 'index'])->name('index');
                Route::get('/{user}/edit', [AdminUsersController::class, 'edit'])->name('edit');
                Route::put('/{user}', [AdminUsersController::class, 'update'])->name('update');
                Route::get('/delete/{user}', [AdminUsersController::class, 'delete'])->name('delete');
                Route::get('/change/admin/{user}', [AdminUsersController::class, 'changeAdmin'])->name('change.admin');
            });
    });




Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
