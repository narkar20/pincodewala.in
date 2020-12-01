<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'HomeController@index');
Route::get('pincode/{pincode}', 'HomeController@pincodeDetails');
Route::get('/getDistrictByState/{state_code}', 'HomeController@getDistrictByState');
Route::get('/getLocationByDistrict/{district_code}', 'HomeController@getLocationByDistrict');
Route::get('/state', 'HomeController@stateList');
Route::get('{state_name}/{district_name}', 'HomeController@districtList');
Route::get('/{state_name}/{district_name}/{location}', 'HomeController@locationList');
Route::get('location', 'HomeController@allLocationList');
Route::get('district', 'HomeController@allDistrictList');
Route::get('{state_name}', 'HomeController@stateList');
