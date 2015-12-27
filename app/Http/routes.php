<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/home',function(){return 'HELLO THERE! YOU ARE ALREADY LOGGED IN';});
Route::get('/', 'Auth\AuthController@getLogin');


Route::get('/apply', function () {
    return view('clearance.init');
});

//This is for the VC view 
Route::get('/vc', 'AdminController@index');
Route::get('/vcpdf', 'AdminController@report');
Route::get('/vcex', 'AdminController@exReport');
//This is for the email functionality.
Route::get('/mail','MailsController@index');

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//Student View
//One cannot access this route if not logged in.
Route::get('student',['middleware' => 'auth', 'uses' => 'ViewsController@index']);
//PDF route !!!
Route::get('pdf',['middleware' => 'auth','uses' => 'ViewsController@show']);

Route::get('/cafeteria', ['middleware' => 'caf','uses' =>'CafeteriaController@index']);
Route::post('/caftclear', 'CafeteriaController@clear');

Route::get('/library', ['middleware' => 'lib','uses' =>'LibraryController@index']);
Route::post('/libclear', 'LibraryController@clear');

Route::get('/games', ['middleware' => 'games','uses' =>'GamesController@index']);
Route::post('/gamesclear', 'GamesController@clear');

Route::get('/extraCurricularActivities', ['middleware' => 'extra','uses' =>'ExtraCurricularActivitiesController@index']);
Route::post('/extraCurricularActivitiesclear', 'ExtraCurricularActivitiesController@clear');

Route::get('/finance', ['middleware' => 'finance','uses' =>'FinanceController@index']);
Route::post('/financeclear', 'FinanceController@clear');

Route::get('/financialAid', ['middleware' => 'financial_aid','uses' =>'FinancialAidController@index']);
Route::post('/financialAidclear', 'FinancialAidController@clear');

Route::post('facClear','FacultyController@clear');
Route::get('/fit', ['middleware' => 'fit','uses' =>'FacultyController@facultyInformationTechnology']);

Route::get('/soa', ['middleware' => 'soa','uses' =>'FacultyController@schoolofAccountancy']);

Route::get('/sfae', ['middleware' => 'sfae','uses' =>'FacultyController@schoolOfFinanceAndAppliedEconomics']);

Route::get('/shss', ['middleware' => 'shss','uses' =>'FacultyController@schoolOfHumanitiesAndSocialSciences']);

Route::get('/smc', ['middleware' => 'smc','uses' =>'FacultyController@schoolOfManagementAndCommerce']);

Route::get('/sbs', ['middleware' => 'sbs','uses' =>'FacultyController@strathmoreBusinessSchool']);

Route::get('/sls', ['middleware' => 'sls','uses' =>'FacultyController@strathmoreLawSchool']);

Route::get('/cth', ['middleware' => 'cth','uses' =>'FacultyController@centreForTourismAndHospitality']);