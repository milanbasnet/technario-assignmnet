<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;

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


Route::get('/', [FrontendController::class, 'index'])->name('welcome');
Route::post('/add/{id}/favorite', [LikeController::class, 'addToFav'])->name('add.favorite');
Route::get('/my/favorite', [LikeController::class, 'myFav'])->name('my.favorite');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin 


Route::group(['middleware' => 'admin.guest', 'prefix' => 'admin'], function () {
    Route::get('/login', [AdminLoginController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'authenticate'])->name('admin.auth')->middleware('throttle:5,1');
});

Route::group(['middleware' => 'admin.auth', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/movies', [MovieController::class, 'index'])->name('movies');
    Route::get('/all/movies', [MovieController::class, 'allMovies'])->name('all.movies');
    Route::get('/users', [MovieController::class, 'userMovies'])->name('user.movies');
    Route::post('/movie/{id}/publish', [MovieController::class, 'moviePublish'])->name('movie.publish');

    Route::get('/movie/create', [MovieController::class, 'create'])->name('movie.create');
    Route::post('/movie/store', [MovieController::class, 'store'])->name('movie.store');
    Route::put('/movie/{id}/edit', [MovieController::class, 'edit'])->name('movie.edit');
    Route::delete('/movie/{id}/delete', [MovieController::class, 'store'])->name('movie.destroy');
});


// Route::group(['middleware' => ['auth', 'Revalidate'], 'prefix' => 'admin'], function () {
//     //Authentication
//     Route::get('/password/change',  [UserController::class, 'changePassword'])->name('user.password.change');
//     Route::post('/password/change',  [UserController::class, 'changeSave'])->name('user.password.update');
// });

// Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function(){
//     Route::namespace('Auth')->group(function(){
//         Route::get('login', [LoginController::class, 'login'])->name('admin.login');
//     });
// });
