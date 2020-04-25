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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/loges',function ()
// {
//     return view('layouts.loges');
// })->name('loges');
Route::get('/Product','ProductController@ShowProductsByCategory')->name('Product');
Route::resource('Products','ProductController');
Route::resource('Comments','CommentController');
Route::resource('Categories','CategoryController');
Route::resource('Categories','CategoryController');
Route::resource('Users','UserController');
Route::get('WorkingCateories','UserController@OwnerCategories')->name('WorkingCateories');
Route::get('My_Account','UserController@My_Account')->name('My_Account');

Route::post('AddUser','CategoryController@AddUserTOTheCategory')->name('AddUser');
// Route::get('Categories','CategoryController@index')->name('Categories.index');
// Route::get('Categories','CategoryController@create')->name('Categories.create');
//Route::get('/Comment','CommentController@create')->name('Comment');