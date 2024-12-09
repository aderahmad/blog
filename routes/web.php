<?php

use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForgotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your applicatio n. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(HomeController::class)->name('web.')->prefix('')->group(function() {
    Route::get('/home', 'home')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/posts', 'posts')->name('posts');
    Route::get('/post/{slug}', 'post')->name('post');
    Route::get('/categories', 'categories')->name('categories');
    Route::get('/authors/{pengguna:username}', 'authors')->name('authors');
});

Route::controller(LoginController::class)->name('login.')->middleware('guest')->prefix('login')->group(function() {
    Route::get('/', 'formLogin')->name('form-login');
    Route::post('/proses-login', 'prosesLogin')->name('proses-login');
});

Route::controller(RegisterController::class)->name('register.')->middleware('guest')->prefix('register')->group(function() {
    Route::get('/register', 'formRegister')->name('form-register');
    Route::post('/proses-register', 'prosesRegister')->name('proses-register');
});

Route::controller(DashboardController::class)->name('dashboard.')->middleware('CekLogin')->prefix('')->group(function() {
    Route::get('/dashboard', 'index')->name('index');
});

Route::controller(LogoutController::class)->name('logout.')->prefix('')->group(function() {
    Route::get('/proses-logout', 'prosesLogout')->name('proses-logout');
});

Route::resource('/dashboard/posts', PostController::class)->names([
    'index' => 'view.post',
    'show' => 'show.post',
    'create' => 'create',
    'store' => 'store.posts',
    'edit' => 'edit',
    'destroy' => 'delete',
    'update' => 'update'
])->middleware('CekLogin');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except(['show', 'edit'])->names([
    'index' => 'view.categories',
    'store' => 'categories.store',
]);

Route::controller(AdminCategoryController::class)->name('category.')->prefix('dashboard/categories')->group(function() {
    Route::get('edit/{category:slug}', 'formEdit')->name('edit');
    Route::get('delete/{category:slug}', 'delete')->name('delete');
    Route::post('update/{category:slug}', 'prosesUpdate')->name('update');
});

Route::controller(ForgotController::class)->name('forgot.')->prefix('forgot')->group(function() {
    Route::get('/', 'formForgot')->name('form-forgot');
    Route::post('/process' , 'processForgot')->name('process-forgot');
    Route::get('/reset-password/{token}', 'resetPassword')->name('reset-password');
    Route::post('/proses-reset', 'prosesResetPassword')->name('proses-reset');
});