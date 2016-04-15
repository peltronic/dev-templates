<?php


Route::get('/', function () {
    return view('welcome');
});



//-------------------------------------------------------------------------
// Admin
//-------------------------------------------------------------------------
// %FIXME: change middleware to 'auth'
Route::group(['middleware'=>['web'],'prefix'=>'admin','namespace'=>'Admin'], function()
{
//$ig = \Auth::user();
//dd($ig);
    // Controllers Within The "App\Http\Controllers\Admin" Namespace

    //Route::get('/users/{pkid}/password', ['as'=>'admin.users.editPassword', 'uses'=>'UsersController@editPassword']);
    //Route::put('/users/updatePassword/{pkid}', ['as'=>'admin.users.updatePassword', 'uses'=>'UsersController@updatePassword']);
    //Route::resource('users', 'UsersController');

    Route::resource('siteconfigs', 'SiteconfigsController');

    Route::get('/', ['as'=>'admin.home', 'uses'=>'HomeController@index']);

});

//-------------------------------------------------------------------------
// Web
//-------------------------------------------------------------------------
Route::group(['middleware' => ['web']], function () {
    Route::get('/siteconfigs', ['as'=>'siteconfigs.show', 'uses'=>'Site\SiteconfigsController@show']);
    //Route::get('/test', ['as'=>'test', 'uses'=>'Site\TestController@show']);
    Route::get('/{slug}', ['as'=>'site.pages.show', 'uses'=>'Site\PagesController@show']);
    Route::get('/', ['as'=>'site.pages.home', 'uses'=>'Site\PagesController@home']);
});
