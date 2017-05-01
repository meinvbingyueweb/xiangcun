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

//测试
Route::get('test','TestController@index');
Route::get('cache_novel','TestController@cacheNovelData');
Route::get('cache_novel_chapt','TestController@cacheNovelChaptData');

// 首页
Route::get('/', 'Front\IndexController@index');

// 章节内容页
Route::get('/{cat_path}/{filename}/{num}.html', 'Front\NovelController@chaptCont')->where([
    'filename'=>'[A-Za-z0-9-_]+',
    'cat_path'=>'[A-Za-z0-9-_]+',
    'num'=>'[0-9]+',
]);

// 小说介绍页
Route::get('/{cat_path}/{filename}/intro.html', 'Front\NovelController@novelIntro')->where([
    'filename'=>'[A-Za-z0-9-_]+',
    'cat_path'=>'[A-Za-z0-9-_]+'
]);

// 小说内容页
Route::get('/{cat_path}/{filename}/', 'Front\NovelController@novelCont')->where([
    'filename'=>'[A-Za-z0-9-_]+',
    'cat_path'=>'[A-Za-z0-9-_]+'
]);

// 分类页
Route::get('/{cat_path}/{page}.html', 'Front\CategoryController@index')->where([
    'page'=>'[0-9]+',
    'cat_path'=>'[A-Za-z0-9-_]+'
]);
Route::get('/{cat_path}/', 'Front\CategoryController@index')->where('cat_path','[A-Za-z0-9-_]+');

