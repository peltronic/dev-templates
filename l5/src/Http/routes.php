<?php


//-------------------------------------------------------------------------
// Default
//-------------------------------------------------------------------------
Route::get('/', function () {
    return view('welcome');
});
// From demo (command php artisan make:auth)
Route::auth();
Route::get('/demo', 'DemoController@index');


//-------------------------------------------------------------------------
// Admin
//-------------------------------------------------------------------------
// %FIXME: change middleware to 'auth'
Route::group(['middleware'=>['web','role:admin'],'prefix'=>'admin','namespace'=>'Admin'], function()
{
//$ig = \Auth::user();
//dd($ig);
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    //Route::get('/users/{pkid}/password', ['as'=>'admin.users.editPassword', 'uses'=>'UsersController@editPassword']);
    //Route::put('/users/updatePassword/{pkid}', ['as'=>'admin.users.updatePassword', 'uses'=>'UsersController@updatePassword']);
    //Route::resource('users', 'UsersController');

    Route::resource('siteconfigs', 'SiteconfigsController');
    Route::resource('users', 'UsersController');

    Route::get('/', ['as'=>'admin.home', 'uses'=>'HomeController@index']);

});

//-------------------------------------------------------------------------
// Auth
//-------------------------------------------------------------------------
Route::group(['middleware' => ['auth']], function () {
    Route::get('/siteconfigs', ['as'=>'siteconfigs.show', 'uses'=>'Site\SiteconfigsController@show']);
});

//-------------------------------------------------------------------------
// Web
//-------------------------------------------------------------------------
Route::group(['middleware' => ['web']], function () {
    Route::get('/login/fb', ['as'=>'auth.doFacebookLogin', 'uses'=>'AuthController@doFacebookLogin']);
    Route::get('/login/fb/callback', ['as'=>'auth.callbackFacebookLogin', 'uses'=>'AuthController@callbackFacebookLogin']);

    // %FIXME: move pages to end
    Route::get('/welcome', ['as'=>'site.welcome', 'uses'=>'Site\WelcomeController@show']);
    Route::get('/{slug}', ['as'=>'site.pages.show', 'uses'=>'Site\PagesController@show']);
    Route::get('/', ['as'=>'site.pages.home', 'uses'=>'Site\PagesController@home']);
});


