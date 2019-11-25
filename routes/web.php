<?php

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
    return redirect()->route('index');
});

Route::get('pullrequest', 'PullRequestController@index')->name('index');
Route::get('pullrequest/create', 'PullRequestController@getCreatePullRequest')->name('create');
Route::post('pullrequest/create', 'PullRequestController@postCreatePullRequest')->name('create');
Route::get('pullrequest/review/{id}', 'PullRequestController@getReviewPullRequest')->name('review');
Route::post('pullrequest/review', 'PullRequestController@postReviewPullRequest')->name('review');
Route::get('pullrequest/fix/{id}', 'PullRequestController@getFixPullRequest')->name('fix');
Route::post('pullrequest/fix', 'PullRequestController@postFixPullRequest')->name('fix');
