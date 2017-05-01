<?php
/**
 *  后台路由
 */

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function (){

    Route::get('/tool/index', 'ToolController@index');#工具

    Route::get('/login', 'LoginController@index')->name('admin.login');#登录页
    Route::post('/login', 'LoginController@auth');#执行登录
    Route::get('/logout', 'LoginController@logout');#执行登出

    Route::group(['middleware'=>'auth.admin'],function (){

        Route::get('/', 'IndexController@index');#首页

        Route::resource('admin_user','AdminUserController');#后台管理员

        Route::post('/admin_menu/clear-cache','MenuController@clearCache');#清除菜单缓存
        Route::resource('admin_menu','MenuController');#菜单管理

        Route::resource('archive','ArchiveController');#文章管理

        Route::post('/arctype/make-cache','ArctypeController@makeCache');#生成缓存
        Route::post('/arctype/clear-cache','ArctypeController@clearCache');#清除缓存
        Route::resource('arctype','ArctypeController');#文章分类管理

        Route::resource('name','NameController');#网名管理
    });
});