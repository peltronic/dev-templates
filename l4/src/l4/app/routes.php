<?php

// ===========================================
// %%% Admin
// ===========================================

Route::get('/admin/login', ['as'=>'admin.showlogin', 'uses'=>'\PsgAdmin\AuthController@showLogin']);
Route::post('/admin/login', ['as'=>'admin.dologin', 'uses'=>'\PsgAdmin\AuthController@doLogin']);
Route::get('/admin/logout', ['as'=>'admin.dologout', 'uses'=>'\PsgAdmin\AuthController@doLogout']);

Route::group(['before'=>'auth.admin', 'prefix'=>'admin','namespace' => 'PsgAdmin'], function()
{
    Route::resource('users', 'UsersController');
    Route::resource('siteconfigs', 'SiteconfigsController');
    Route::get('/', ['as'=>'admin.home', 'uses'=>'HomeController@index']);
}); // admin

// ===========================================
// %%% Site
// ===========================================

Route::group(['namespace' => 'PsgSite'], function()
{
    Route::resource('siteconfigs', 'SiteconfigsController');
    Route::get('/{slug}', ['as'=>'site.pages.show', 'uses'=>'PagesController@show']);
}); // site

// ===========================================
// %%% Api
// ===========================================

Route::group(['namespace' => 'PsgApi'], function()
{
    Route::resource('siteconfigs', 'SiteconfigsController');
}); // api

Route::get('/', ['as'=>'site.home', 'uses'=>'\PsgSite\HomeController@show']);
