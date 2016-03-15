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
  Route::get('pdf', 'ViewsController@show');

  //Staff Views
  // Departments
  Route::get('/cafeteria', 'CafeteriaController@index');
  Route::post('/caftclear', 'CafeteriaController@clear');

  Route::get('/games', 'GamesController@index');
  Route::post('/gamesclear', 'GamesController@clear');

  Route::get('/library', 'LibraryController@index');
  Route::post('/libclear', 'LibraryController@clear');

  Route::get('/extraCurricularActivities', 'ExtraCurricularActivitiesController@index');
  Route::post('/extraCurricularActivitiesclear', 'ExtraCurricularActivitiesController@clear');

  Route::get('/finance', 'FinanceController@index');
  Route::post('/financeclear', 'FinanceController@clear');
  Route::post('/financeupdate', 'FinanceController@update');

  Route::get('/financialAid', 'FinancialAidController@index');
  Route::post('/financialAidclear', 'FinancialAidController@clear');

  Route::get('/extraCurricularActivities', 'ExtraCurricularActivitiesController@index');
  Route::post('/extraCurricularActivitiesclear', 'ExtraCurricularActivitiesController@clear');

  Route::get('/finance', 'FinanceController@index');
  Route::post('/financeclear', 'FinanceController@clear');
  Route::post('/financeupdate', 'FinanceController@update');

  Route::get('/financialAid', 'FinancialAidController@index');
  Route::post('/financialAidclear', 'FinancialAidController@clear');

  // Schools
  Route::post('facClear','FacultyController@clear');

  Route::get('/fit','FacultyController@facultyInformationTechnology');
  Route::get('/soa','FacultyController@schoolofAccountancy');
  Route::get('/sfae', 'FacultyController@schoolOfFinanceAndAppliedEconomics');
  Route::get('/shss', 'FacultyController@schoolOfHumanitiesAndSocialSciences');
  Route::get('/smc', 'FacultyController@schoolOfManagementAndCommerce');
  Route::get('/sbs', 'FacultyController@strathmoreBusinessSchool');
  Route::get('/sls', 'FacultyController@strathmoreLawSchool');
  Route::get('/cth', 'FacultyController@centreForTourismAndHospitality');

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
Route::get('/add', 'SuperUser@displayAdd');
Route::post('/addStaff', 'SuperUser@search');
Route::get('/addStaff', 'SuperUser@search');
Route::get('/authenticateStaff', 'SuperUser@authorize');
Route::post('/authenticateStaff', 'SuperUser@authorize');
Route::post('mwas','SuperUser@modify');
Route::get('/stdsearch', 'SuperUser@studentSearch');
Route::post('/stdsearch', 'SuperUser@studentSearch');
Route::get('/stdview', 'SuperUser@studentView');

Route::get('/brian', function(){
  return view('test');
});
