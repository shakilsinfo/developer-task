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


// -----------BackEnd Routes--------------------------//

Route::get('/',function(){
	return redirect('/login');
});
Auth::routes();

Route::group(['middleware'=>['auth']],function(){

	Route::get('dashboard', 'DashboardController@index')->name('route.dashboard');
// ==============Customer Entry Route=============
	Route::resource('customer-list', 'CustomerController');
	Route::resource('bill-generate', 'CustomerBillController');
// ==============Customer Monthly bill route========

	
});
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});

//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});

//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});

//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});

