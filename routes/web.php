<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CompanyController;
use App\Http\Controllers\Backend\CountryStateCityController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\StreamController;
use App\Http\Controllers\Backend\ProgramController;
use App\Http\Controllers\Backend\ReplayController;
use App\Http\Controllers\Backend\PodcastController;
use App\Http\Controllers\Backend\InterviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/
Route::get('/',function(){
     return view('frontend.front');
});

Route::get('/list/',function(){
     return view('frontend.front');
});

Route::get('/detail/{id}/',function(){
     return view('frontend.front');
});


/**AUTH MANGEMENT */
Route::get('/admin-login', [AuthController::class, 'index'])->name('admin-login');
Route::post('/adminauth', [AuthController::class, 'authenticate'])->name('adminauth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

/**ANALYTICS ROUTES */
Route::get('/analytics', [DashboardController::class, 'index'])->name('analytics');

/**Manage User Route */
Route::get('/analytics-users', [UserController::class, 'index'])->name('users');
Route::post('/create-user', [UserController::class, 'create'])->name('create-user');
Route::post('/update-user', [UserController::class, 'update'])->name('update-user'); 
Route::post('/status-user', [UserController::class, 'update_status'])->name('status-user');
Route::post('/password-user', [UserController::class, 'update_password'])->name('password-user');
Route::post('/delete-user', [UserController::class, 'delete'])->name('delete-user');


Route::post('get-states-by-country', [CountryStateCityController::class, 'getState'])->name('get-states-by-country');
Route::post('get-cities-by-state', [CountryStateCityController::class, 'getCity'])->name('get-cities-by-state');

/** Manage Company Infos Route */
Route::get('/company', [CompanyController::class, 'index'])->name('company'); 
Route::post('/create-company', [CompanyController::class, 'create'])->name('create-company'); 
Route::post('/update-company', [CompanyController::class, 'update'])->name('update-company'); 


Route::get('/banner', [BannerController::class, 'index'])->name('banner');
Route::post('/create-banner', [BannerController::class, 'create'])->name('create-banner');
Route::post('/update-banner', [BannerController::class, 'update'])->name('update-banner');
Route::post('/delete-banner', [BannerController::class, 'delete'])->name('delete-banner');
Route::post('/status-banner', [BannerController::class, 'status'])->name('status-banner');
Route::post('/validation-banner', [BannerController::class, 'validation'])->name('validation-banner');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::post('/create-category', [CategoryController::class, 'create'])->name('create-category');
Route::post('/update-category', [CategoryController::class, 'update'])->name('update-category');
Route::post('/delete-category', [CategoryController::class, 'delete'])->name('delete-category');
Route::post('/status-category', [CategoryController::class, 'status'])->name('status-category');

Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::post('/create-news', [NewsController::class, 'create'])->name('create-news');
Route::post('/update-news', [NewsController::class, 'update'])->name('update-news');
Route::post('/delete-news', [NewsController::class, 'delete'])->name('delete-news');
Route::post('/status-news', [NewsController::class, 'status'])->name('status-news');
Route::post('/validation-news', [NewsController::class, 'validation'])->name('validation-news');

Route::get('/stream', [StreamController::class, 'index'])->name('stream');
Route::post('/create-stream', [StreamController::class, 'create'])->name('create-stream');
Route::post('/update-stream', [StreamController::class, 'update'])->name('update-stream');
Route::post('/delete-stream', [StreamController::class, 'delete'])->name('delete-stream');
Route::post('/status-stream', [StreamController::class, 'status'])->name('status-stream');
Route::post('/validation-stream', [StreamController::class, 'validation'])->name('validation-stream');

Route::get('/program', [ProgramController::class, 'index'])->name('program');
Route::post('/create-program', [ProgramController::class, 'create'])->name('create-program');
Route::post('/update-program', [ProgramController::class, 'update'])->name('update-program');
Route::post('/delete-program', [ProgramController::class, 'delete'])->name('delete-program');
Route::post('/status-program', [ProgramController::class, 'status'])->name('status-program');
Route::post('/validation-program', [ProgramController::class, 'validation'])->name('validation-program');

Route::get('/replay', [ReplayController::class, 'index'])->name('replay');
Route::post('/create-replay', [ReplayController::class, 'create'])->name('create-replay');
Route::post('/update-replay', [ReplayController::class, 'update'])->name('update-replay');
Route::post('/delete-replay', [ReplayController::class, 'delete'])->name('delete-replay');
Route::post('/status-replay', [ReplayController::class, 'status'])->name('status-replay');
Route::post('/validation-replay', [ReplayController::class, 'validation'])->name('validation-replay');

Route::get('/podcast', [PodcastController::class, 'index'])->name('podcast');
Route::post('/create-podcast', [PodcastController::class, 'create'])->name('create-podcast');
Route::post('/update-podcast', [PodcastController::class, 'update'])->name('update-podcast');
Route::post('/delete-podcast', [PodcastController::class, 'delete'])->name('delete-podcast');
Route::post('/status-podcast', [PodcastController::class, 'status'])->name('status-podcast');
Route::post('/validation-podcast', [PodcastController::class, 'validation'])->name('validation-podcast');
Route::post('/sponsoring-podcast', [PodcastController::class, 'sponsoring'])->name('sponsoring-podcast');

Route::get('/interview', [InterviewController::class, 'index'])->name('interview');
Route::post('/create-interview', [InterviewController::class, 'create'])->name('create-interview');
Route::post('/update-interview', [InterviewController::class, 'update'])->name('update-interview');
Route::post('/delete-interview', [InterviewController::class, 'delete'])->name('delete-interview');
Route::post('/status-interview', [InterviewController::class, 'status'])->name('status-interview');
Route::post('/validation-interview', [InterviewController::class, 'validation'])->name('validation-interview');