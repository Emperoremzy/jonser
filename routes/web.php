<?php

use Illuminate\Support\Facades\Route;
use App\post;
use App\comment;

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
    $comments = comment::all();
    $count = comment::all()->count();
     $post=  post::all();
    return view('category',['post'=>$post],['comments'=>$comments],['count'=>$count]);
});
Route::get('contact', function () {
    return view('contact');
});



Auth::routes();


Route::get('/category', 'HomeController@user')->name('category');
Route::GET('/category/{id}/{user}', 'HomeController@createCmt');
Route::get('/adminHome', 'HomeController@adminHome')->name('adminHome')->middleware('is_admin');
Route::post('/adminHome', 'HomeController@createPost')->middleware('is_admin');
Route::delete('/adminHome/{id}', 'HomeController@destroy')->middleware('is_admin');