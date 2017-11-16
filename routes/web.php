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
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'auth','namespace' => 'Admin'], function () {
    Route::get('admin/index', 'AdminController@index')->name('home');
    Route::get('/data/view', 'DataControlController@dataView')->name('dataview')->middleware('inputer');
    Route::get('/data/add', 'DataControlController@dataAddition')->name('dataimport')->middleware('inputer');
    Route::post('data/add', 'DataControlController@postDataAddition')->name('postdata')->middleware('inputer');
    Route::get('data/edit/{id}', 'DataControlController@DataEdit');
    Route::post('data/edit/{id}', 'DataControlController@postDataEdit')->name('postdataedit');
    Route::get('data/delete/{id}', 'DataControlController@DataDelete');
    Route::get('data/unclaimed', 'DataControlController@dataUnclaimed')->name('dataunclaimed')->middleware('service');
    Route::post('/unclaimed/status/{id}', 'DataControlController@dataUnclaimedStatus')->middleware('service');
    Route::get('data/customerservice', 'DataControlController@Customerservice')->name('customerservice')->middleware('service');
    Route::get('data/customervisit', 'DataControlController@CustomerVisit')->name('customervisit')->middleware('store');
    Route::get('/data/customervisit/own', 'DataControlController@CustomerVisitOwn')->name('customervisitown')->middleware('store');
    Route::post('/unreception/status/{id}', 'DataControlController@dataReceptionStatus')->middleware('store');
    Route::get('/sysconf/refereradd', 'SysconfControlController@refererAdd');
    Route::post('/sysconf/refereradd', 'SysconfControlController@postRefererAdd')->name('refereradd');
    Route::get('/sysconf/refereraddlist', 'SysconfControlController@refererList')->name('refererlist');
    Route::get('/sysconf/packageadd', 'SysconfControlController@packageAdd');
    Route::post('/sysconf/packgeadd', 'SysconfControlController@postPackageAdd')->name('packageadd');
    Route::get('/sysconf/packagelist', 'SysconfControlController@packageList')->name('packagelist');
    Route::get('/sysconf/advertisementadd', 'SysconfControlController@advertisementAdd');
    Route::post('/sysconf/advertisementadd', 'SysconfControlController@postAdvertisementAdd')->name('advertisementadd');
    Route::get('/sysconf/advertisementlist', 'SysconfControlController@advertisementList')->name('advertisementlist');
    Route::get('user/list','UserController@userLists')->name('userlist');
    Route::get('/adminuser/edit/{id}','UserController@adminUserEdit');
    Route::post('/adminuser/edit/{id}','UserController@adminPostUserEdit')->name('adminuser.edit');
    Route::get('user/group','UserGroupController@groupLists')->name('grouplist');
    Route::get('/user/groupcreate','UserGroupController@groupCreate');
    Route::post('/user/groupcreate','UserGroupController@postGroupCreate');
    Route::get('/usergroup/edit/{id}','UserGroupController@groupEdit');
    Route::put('/usergroup/edit/{id}','UserGroupController@postGroupEdit')->name('groupedit');

});
