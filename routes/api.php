<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthAPI;
use App\Http\Controllers\Api\BannerAPI;
use App\Http\Controllers\Api\NewsAPI;
use App\Http\Controllers\Api\ProgramAPI;
use App\Http\Controllers\Api\ReplayAPI;
use App\Http\Controllers\Api\PodcastAPI;
use App\Http\Controllers\Api\StreamAPI;
use App\Http\Controllers\Api\HomeAPI;
use App\Http\Controllers\Api\InterviewAPI;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('/auth', [AuthAPI::class, 'login']);
Route::post('/register', [AuthAPI::class, 'register']);

Route::group(['middleware' => 'auth:api'], function() {

    /**Home */
    Route::get('home', [HomeAPI::class, 'index']);
    
    /**Banner */
    Route::get('banner', [BannerAPI::class, 'index']);

    /**News */
    Route::get('news', [NewsAPI::class, 'index']);
    Route::get('one-news/{id}/', [NewsAPI::class, 'one_news']);
    Route::get('news-category/{category}/', [NewsAPI::class, 'news_category']);
    Route::get('news-country/{country}/', [NewsAPI::class, 'news_country']);
    Route::get('news-priority/{priority}/', [NewsAPI::class, 'news_priority']);

    /**Interview */
    Route::get('interview', [InterviewAPI::class, 'index']);
    Route::get('one-interview/{id}/', [InterviewAPI::class, 'one_interview']);
    Route::get('interview-category/{category}/', [InterviewAPI::class, 'interview_category']);
    Route::get('interview-country/{country}/', [InterviewAPI::class, 'interview_country']);

    /**Program */
    Route::get('program', [ProgramAPI::class, 'index']);
    Route::get('one-program/{id}/', [ProgramAPI::class, 'one_program']);

    /**Replay */
    Route::get('replay', [ReplayAPI::class, 'index']);
    Route::get('one-replay/{id}/', [ReplayAPI::class, 'one_replay']);
    Route::get('replay-program/{program}/', [ReplayAPI::class, 'replay_program']);

    /**Podcast */
    Route::get('podcast', [PodcastAPI::class, 'index']);
    Route::get('podcast-program/{program}/', [PodcastAPI::class, 'podcast_program']);
    Route::get('podcast-sponsoring/', [PodcastAPI::class, 'podcast_sponsoring']);

    /**Stream */
    Route::get('stream', [StreamAPI::class, 'index']);
});