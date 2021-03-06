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

Route::group(['middleware' => ['cas.auth']], function (){
  // home page
  Route::get('/clearance', 'RedirectController@index');
  Route::get('/', 'RedirectController@index');
  // logout
  Route::get('/logout','RedirectController@destroy');

  // student page
  Route::get('/activate','InitiateController@index');
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
  Route::post('/financeupdate', 'FinanceController@update');

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


});

Route::get('mwas','ViewsController@leadership');


//This is for the VC view
Route::get('/vc', 'AdminController@index');
Route::get('/vcpdf', 'AdminController@report');
Route::get('/vcxls', 'AdminController@exReport');



//Administrator Route
Route::get('admin',function(){
    return view('admin.admin');
});
Route::get('mwas','SuperUser@index');
Route::get('/authorize', 'SuperUser@displayAdd');
Route::post('/addStaff', 'SuperUser@search');
Route::get('/addStaff', 'SuperUser@search');
Route::get('/authenticateStaff', 'SuperUser@authorize');
Route::post('/authenticateStaff', 'SuperUser@authorize');
Route::post('mwas','SuperUser@modify');
Route::get('/studentsearch', 'SuperUser@studentSearch');
Route::post('/studentsearch', 'SuperUser@studentSearch');
Route::get('/studentview', 'SuperUser@studentView');
Route::get('/clearancereport', 'SuperUser@clearanceReport');
Route::get('financialreport','SuperUser@financialReport');

Route::get('/supdf', 'SuperUser@exportPdf');
Route::get('/suexc', 'SuperUser@exportExc');
Route::get('/exports', function(){
  return view('admin.exports');
});
