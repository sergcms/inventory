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

Route::get('/', function () { return view('welcome'); });

Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/register', function () { return view('welcome'); });

Route::get('recaptchacreate', 'RecaptchaController@create');
Route::post('store', 'RecaptchaController@store');

Route::prefix("/department")->middleware(['auth', 'isblock', 'role:admin'])->group(function () {
    
    Route::get('/', 'DepartmentController@list')->name('department');    
        
    Route::get('/create', 'DepartmentController@show');
    Route::post('/create', 'DepartmentController@create')->name('department-create');
    
    Route::get('/edit/{id}', 'DepartmentController@show')->name('department-edit');
    Route::post('/edit/{id}', 'DepartmentController@update')->name('department-update');
    
    Route::get('/delete/{id}', 'DepartmentController@delete')->name('department-delete');
});

Route::prefix("/device")->middleware(['auth', 'isblock'])->group(function () {
    
    Route::get('/', 'DeviceController@list')->name('device');    
        
    Route::get('/create', 'DeviceController@show');
    Route::post('/create', 'DeviceController@create')->name('device-create');
    
    Route::get('/edit/{id}', 'DeviceController@show')->name('device-edit');
    Route::post('/edit/{id}', 'DeviceController@update')->name('device-update');
    
    Route::get('/delete/{id}', 'DeviceController@delete')->name('device-delete');
});

Route::prefix("/card")->middleware(['auth', 'isblock'])->group(function () {
    
    Route::get('/', 'CardController@list')->name('card');    
        
    Route::get('/create', 'CardController@show');
    Route::post('/create', 'CardController@create')->name('card-create');
    
    Route::get('/edit/{id}', 'CardController@show')->name('card-edit');
    Route::post('/edit/{id}', 'CardController@update')->name('card-update');
    
    Route::get('/delete/{id}', 'CardController@delete')->name('card-delete');
});

Route::prefix("/report")->middleware(['auth'])->group(function () {
   
    Route::get('/', 'DeviceController@show');

    Route::get('/{id}', 'ReportController@report')->name('info');

    Route::get('/device', 'ReportController@showForm')->name('show-form-report-device');
    Route::post('/device', 'ReportController@showReport')->name('report-device');

    Route::get('/department', 'ReportController@showForm')->name('show-form-report-department');
    Route::post('/department', 'ReportController@showReport')->name('report-department');
});

Route::prefix("/user")->middleware(['auth', 'role:admin'])->group(function () {
   
    Route::get('/', 'UserController@list')->name('user');    
        
    Route::get('/create', 'UserController@showForm');
    Route::post('/create', 'UserController@create')->name('user-create');
    
    Route::get('/edit/{id}', 'UserController@showForm')->name('user-edit');
    Route::post('/edit/{id}', 'UserController@update')->name('user-update');
    
    Route::get('/delete/{id}', 'UserController@delete')->name('user-delete');
});

// Route::get('/report/{id}', 'ReportController@report')->name('info');