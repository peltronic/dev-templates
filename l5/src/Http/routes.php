<?php


Route::get('/', function () {
    return view('welcome');
});



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

// From demo (command php artisan make:auth)
Route::auth();
Route::get('/demo', 'DemoController@index');
//Route::get('/home', 'HomeController@index');

//-------------------------------------------------------------------------
// Web
//-------------------------------------------------------------------------
Route::group(['middleware' => ['web']], function () {
    Route::get('/siteconfigs', ['as'=>'siteconfigs.show', 'uses'=>'Site\SiteconfigsController@show']);
    //Route::get('/test', ['as'=>'test', 'uses'=>'Site\TestController@show']);

    // %FIXME: move pages to end
    Route::get('/{slug}', ['as'=>'site.pages.show', 'uses'=>'Site\PagesController@show']);
    Route::get('/', ['as'=>'site.pages.home', 'uses'=>'Site\PagesController@home']);
});

