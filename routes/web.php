<?php

use App\Http\Controllers\Admin\CategoriesController as AdminCategoriesController;
use App\Http\Controllers\Admin\CommentsController as AdminCommentsController;
use App\Http\Controllers\Admin\ComplaintsController as AdminComplaintsController;
use App\Http\Controllers\Admin\IndexController as AdminController;
use App\Http\Controllers\Admin\PostsController as AdminPostsController;
use App\Http\Controllers\Admin\ReasonsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ComplaintsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\SocialiteController;
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
Route::get('auth/{provider}/redirect', [SocialiteController::class, 'redirect'])->name('auth.redirect');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])->name('auth.callback');



Route::view('/', 'index')->name('home');

Route::get('/users/{user}', [UsersController::class,'show'])->name('users.show');


Route::name('posts.')
    ->middleware('auth')
    ->prefix('posts')
    ->group(function () {
        Route::get('/my', [PostsController::class, 'indexUser'])->name('index.my');
        Route::post('/{post}/add/like', [PostsController::class, 'addLike'])->name('like.add');
        Route::get('/create', [PostsController::class, 'create'])->name('create');
        Route::post('/store', [PostsController::class, 'store'])->name('store');
        Route::put('/{post}', [PostsController::class, 'update'])->name('update');
        Route::get('/{post}/edit', [PostsController::class, 'edit'])->name('edit');
        Route::delete('/{post}', [PostsController::class, 'delete'])->name('delete');
    });


Route::get('posts/{post}', [PostsController::class, 'show'])->where('id', '[0-9]+')->name('posts.show');
Route::get('posts/', [PostsController::class, 'index'])->name('posts.index');





Route::name('comments.')
    ->middleware('auth')
    ->prefix('comments')
    ->group(function () {
        Route::post('/store', [CommentsController::class, 'store'])->name('store');
        Route::get('/create/{id}', [CommentsController::class, 'create'])->name('create');
        Route::delete('/delete/{comment}', [CommentsController::class, 'delete'])->name('delete');
        Route::put('/{comment}', [CommentsController::class, 'update'])->name('update');
        Route::get('/{comment}/edit', [CommentsController::class, 'edit'])->name('edit');

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
                Route::delete('/delete/{post}', [AdminPostsController::class, 'delete'])->name('delete');
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
                Route::delete('/delete/{category}', [AdminCategoriesController::class, 'delete'])->name('delete');
                Route::get('/show/{id}', [AdminCategoriesController::class, 'show'])->name('show');
            });
        Route::name('users.')
            ->prefix('users')
            ->group(function () {
                Route::get('/', [AdminUsersController::class, 'index'])->name('index');
                Route::get('/{user}/edit', [AdminUsersController::class, 'edit'])->name('edit');
                Route::put('/{user}', [AdminUsersController::class, 'update'])->name('update');
                Route::delete('/delete/{user}', [AdminUsersController::class, 'delete'])->name('delete');
                Route::get('/change/admin/{user}', [AdminUsersController::class, 'changeAdmin'])->name('change.admin');
            });
        Route::name('comments.')
            ->prefix('comments')
            ->group(function () {
                Route::get('/', [AdminCommentsController::class, 'index'])->name('index');
                Route::get('/create', [AdminCommentsController::class, 'create'])->name('create');
                Route::post('/store', [AdminCommentsController::class, 'store'])->name('store');
                Route::put('/{comment}', [AdminCommentsController::class, 'update'])->name('update');
                Route::get('/{comment}/edit', [AdminCommentsController::class, 'edit'])->name('edit');
                Route::delete('/delete/{comment}', [AdminCommentsController::class, 'delete'])->name('delete');
            });
        Route::name('complaints.')
            ->prefix('complaints')
            ->group(function () {
                Route::get('/', [AdminComplaintsController::class, 'index'])->name('index');
                Route::get('/show/{complaint}', [AdminComplaintsController::class, 'show'])->name('show');
                Route::delete('/delete/{complaint}/post', [AdminComplaintsController::class, 'deletePost'])->name('delete.post');
                Route::delete('/delete/{complaint}/user', [AdminComplaintsController::class, 'deleteUser'])->name('delete.user');
                Route::delete('/delete/{complaint}', [AdminComplaintsController::class, 'delete'])->name('delete');
            });
        Route::name('reasons.')
            ->prefix('reasons')
            ->group(function () {
                Route::get('/', [ReasonsController::class, 'index'])->name('index');
                Route::delete('/delete/{reason}', [ReasonsController::class, 'delete'])->name('delete');
                Route::get('/create', [ReasonsController::class, 'create'])->name('create');
                Route::post('/store', [ReasonsController::class, 'store'])->name('store');
                Route::put('/{reason}', [ReasonsController::class, 'update'])->name('update');
                Route::get('/{reason}/edit', [ReasonsController::class, 'edit'])->name('edit');
            });
    });


Route::name('complaints.')
    ->middleware('auth')
    ->prefix('complaints')
    ->group(function () {
        Route::get('/create/{id}', [ComplaintsController::class, 'create'])->name('create');
        Route::post('/store', [ComplaintsController::class, 'store'])->name('store');
    });


Auth::routes();

