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
    Route::get('/importdatas', 'ArticleController@ImportDatas')->name('import');
    Route::post('/importdatas', 'ArticleController@PostImportDatas')->name('import');
    Route::get('/data/{option?}', 'ArticleController@ViewArticleDatas')->name('dataoption');
    Route::get('/article/{id}', 'ArticleController@Previewdatas')->name('preview');
    Route::get('/article/del/{id}', 'ArticleController@DeleteContentdatas');
    Route::get('/article/edit/{id}', 'ArticleController@EditArticledatas')->name('editarticle');
    Route::post('/article/edit/{id}', 'ArticleController@PostEditArticledatas');
    Route::get('/articlecreate', 'ArticleController@ArticleCreate')->name('articlecreate');
    Route::post('/articlecreate', 'ArticleController@PostArticleCreate')->name('articlecreate');
    Route::get('/branddatas/{options?}', 'BrandDatasController@Index')->name('branddatas');
    Route::get('/branddatas/del/{id}', 'BrandDatasController@Delete');

    Route::post('/status/{id}', 'BrandDatasController@Status')->name('status');
    Route::get('/user/list', 'UserController@Index')->name('users');
    Route::get('/user/del/{id}', 'UserController@Delete');
    Route::get('/user/edit/{id}', 'UserController@UserEdit');
    Route::get('/adminuser/edit/{id}', 'UserController@AdminUserEdit');
    Route::post('/user/edit/{id}', 'UserController@PostUserEdit');
    Route::get('/user/group', 'UserController@UserGroup')->name('usergroup');
    Route::get('/user/groupcreate', 'UserController@UserGroupCreate');
    Route::get('/usergroup/edit/{id}', 'UserController@UserGroupEdit');
    Route::post('/user/groupedit/{id}', 'UserController@PostUserGroupEdit');
    Route::post('/user/groupcreate', 'UserController@PostUserGroupCreate');
    Route::get('/works/articleimport', 'WorkController@ArticleImport');
    Route::post('/works/articleimport', 'WorkController@PostArticleImport');
    Route::get('/works', 'WorkController@Index')->name('works');
    Route::get('/works/tuimport', 'WorkController@WaituiInport');
    Route::post('/works/tuimport', 'WorkController@PostWaituiInport');
    Route::get('/workstui', 'WorkController@IndexTui')->name('workstui');



});
