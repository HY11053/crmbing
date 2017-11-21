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

Route::get('/','Auth\LoginController@showLoginForm')->name('login');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('/logout', 'Auth\LoginController@logout');
Route::group(['middleware' => 'auth','namespace' => 'Admin'], function () {
    Route::get('admin/index', 'AdminController@index')->name('home');
    Route::get('/data/view', 'DataControlController@dataView')->name('dataview')->middleware('inputer');
    Route::get('/data/add', 'DataControlController@dataAddition')->name('dataimport')->middleware('inputer');
    Route::post('data/add', 'DataControlController@postDataAddition')->name('postdata')->middleware('inputer');
    Route::get('data/edit/{id}', 'DataControlController@DataEdit');
    Route::post('data/edit/{id}', 'DataControlController@postDataEdit')->name('postdataedit');
    Route::get('/service/edit/{id}', 'DataControlController@ServiceDataEdit');
    Route::post('/service/edit/{id}', 'DataControlController@PostServiceDataEdit')->name('servicedataedit');
    Route::get('/visit/edit/{id}', 'DataControlController@VisitDataEdit');
    Route::post('/visit/edit/{id}', 'DataControlController@PostVisitDataEdit')->name('visitdataedit');
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
    Route::get('/sysconf/refereredit/{id}', 'SysconfControlController@refererEdit');
    Route::post('/sysconf/refereredit/{id}', 'SysconfControlController@postRefererEdit')->name('refereredit');
    Route::get('/sysconf/referetelete/{id}', 'SysconfControlController@refererDetele');
    Route::get('/sysconf/packageadd', 'SysconfControlController@packageAdd');
    Route::post('/sysconf/packgeadd', 'SysconfControlController@postPackageAdd')->name('packageadd');
    Route::get('/sysconf/packagelist', 'SysconfControlController@packageList')->name('packagelist');
    Route::get('/sysconf/packagedit/{id}', 'SysconfControlController@packageEdit');
    Route::post('/sysconf/packagedit/{id}', 'SysconfControlController@postPackageEdit')->name('package_edit');
    Route::get('/sysconf/packagedel/{id}', 'SysconfControlController@packageDelete');
    Route::get('/sysconf/advertisementadd', 'SysconfControlController@advertisementAdd');
    Route::post('/sysconf/advertisementadd', 'SysconfControlController@postAdvertisementAdd')->name('advertisementadd');
    Route::get('/sysconf/advertisementlist', 'SysconfControlController@advertisementList')->name('advertisementlist');
    Route::get('/sysconf/advertisementedit/{id}', 'SysconfControlController@advertisementEdit');
    Route::post('/sysconf/advertisementedit/{id}', 'SysconfControlController@postAdvertisementEdit')->name('advertisementedit');
    Route::get('/sysconf/advertisementdelete/{id}', 'SysconfControlController@advertisementDelete');
    Route::get('/user/register', 'RegisterController@showRegistrationForm');
    Route::post('/user/register', 'RegisterController@register')->name('userregister');
    Route::get('user/list','UserController@userLists')->name('userlist');
    Route::get('user/add','UserController@userAdd')->name('userAdd');
    Route::get('/adminuser/edit/{id}','UserController@adminUserEdit')->middleware('usercheck');
    Route::post('/adminuser/edit/{id}','UserController@adminPostUserEdit')->name('adminuser.edit');
    Route::get('user/del/{id}','UserController@userDelete');
    Route::get('user/group','UserGroupController@groupLists')->name('grouplist');
    Route::get('/user/groupcreate','UserGroupController@groupCreate');
    Route::post('/user/groupcreate','UserGroupController@postGroupCreate');
    Route::get('/usergroup/edit/{id}','UserGroupController@groupEdit');
    Route::put('/usergroup/edit/{id}','UserGroupController@postGroupEdit')->name('groupedit');
    Route::get('/inputer/index','DataAnalysisController@inputerAnalysis');
    Route::get('/customerservice/index','DataAnalysisController@customerserviceAnalysis');
    Route::get('/customervisit/index','DataAnalysisController@customervisitAnalysis');
    Route::get('customer/success','DataAnalysisController@customerSuccessAnalysis');
    Route::get('customer/unsuccess','DataAnalysisController@customerUnsuccessAnalysis');
    Route::get('/importdatastxt','DataImportController@dataImportText');
    Route::put('/importdatastxt','DataImportController@putDataImportText')->name('textimport');


});
