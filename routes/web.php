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
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'auth','namespace' => 'Admin'], function () {
    Route::get('/home', 'AdminController@index')->name('home');
    Route::get('/data/view', 'DataControlController@dataView')->name('dataview');
    Route::get('/data/add', 'DataControlController@dataAddition')->name('dataimport');
    Route::post('data/add', 'DataControlController@postDataAddition')->name('postdata');
    Route::get('data/unclaimed', 'DataControlController@dataUnclaimed')->name('dataunclaimed');
    Route::get('/sysconf/refereradd', 'SysconfControlController@refererAdd');
    Route::post('/sysconf/refereradd', 'SysconfControlController@postRefererAdd')->name('refereradd');
    Route::get('/sysconf/refereraddlist', 'SysconfControlController@refererList')->name('refererlist');
    Route::get('/sysconf/packageadd', 'SysconfControlController@packageAdd');
    Route::post('/sysconf/packgeadd', 'SysconfControlController@postPackageAdd')->name('packageadd');
    Route::get('/sysconf/packagelist', 'SysconfControlController@packageList')->name('packagelist');
    Route::get('/sysconf/advertisementadd', 'SysconfControlController@advertisementAdd');
    Route::post('/sysconf/advertisementadd', 'SysconfControlController@postAdvertisementAdd')->name('advertisementadd');
    Route::get('/sysconf/advertisementlist', 'SysconfControlController@advertisementList')->name('advertisementlist');
});
