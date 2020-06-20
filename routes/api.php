<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('getHtcDueSatus/{regno}', 'Api\ApiController@getHtcDueSatus');
Route::get('getPositiveClientsCount/{code}', 'Api\ApiController@getPositiveClientsCount');
Route::get('getPositiveClientsList', 'Api\ApiController@getPositiveClientsList');
Route::get('getAdherenceStatus/{id}', 'Api\ApiController@getAdherenceStatus');
Route::get('getArvRefillDate/{id}', 'Api\ApiController@getArvRefillDate');


Route::get('clientCount', 'DashboardController@clientCount');
Route::get('clientTested', 'DashboardController@clientTested');
Route::get('byCitiesPWID', 'DashboardController@byCitiesPWID');
Route::get('byCitiesSpouse', 'DashboardController@byCitiesSpouse');
Route::get('annualClients', 'DashboardController@annualClients');
Route::get('annualSpouse', 'DashboardController@annualSpouse');
Route::get('htcClientSpouseAllCities', 'DashboardController@HtcClientSpousePrevalence');
Route::get('individualServiceContact', 'DashboardController@IndividualServiceContact');
Route::get('targetNSEPQuarterP3', 'DashboardController@targetNSEPQuarterP3_2020');
Route::get('targetHTCQuarterP3', 'DashboardController@targetHTCQuarterP3_2020');
Route::get('targetContactPerSyringesP3', 'DashboardController@targetContactPerSyringesP3_2020');

Route::get('byCopcPWID/{id}', 'DashboardController@RptDashboardCascadingPWIDCOPC');
Route::get('byCopcSpouse/{id}', 'DashboardController@RptDashboardCascadingSpousesCOPC');
Route::get('byCopcHtcClient/{id}', 'DashboardController@RptDashboardHTCClientSpouseCity');
