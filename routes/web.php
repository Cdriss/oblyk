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

//page d'accueille
Route::get('/', function () {return view('pages.home.index');});

Auth::routes();


//Route::get('/home', 'HomeController@index');

//page liée au projet
Route::get('/le-projet', 'ProjectPagesController@projectPage')->name('project');
Route::get('/qui-sommes-nous', 'ProjectPagesController@whoPage')->name('who');
Route::get('/contact', 'ProjectPagesController@contactPage')->name('contact');
Route::get('/a-propos', 'ProjectPagesController@aboutPage')->name('about');
Route::get('/aides', 'ProjectPagesController@helpPage')->name('help');
Route::get('/nous-soutenire', 'ProjectPagesController@supportUsPage')->name('supportUs');
Route::get('/developpeur', 'ProjectPagesController@developerPage')->name('developer');
Route::get('/conditions-utilisation', 'ProjectPagesController@termsOfUsePage')->name('termsOfUse');


//carte
Route::get('/carte-des-falaises', 'MapController@mapPage')->name('map');


//outdoor
Route::get('/site-escalade/{crag_id}/{crag_label}', 'CragController@cragPage');
Route::get('/API/crags/{lat}/{lng}/{rayon}', 'MapController@getPopupMarkerAroundPoint')->name('APIMarkerMap');


//MODAL
Route::post('/modal/crag', 'CRUD\CragController@cragModal')->name('cragModal');
Route::post('/modal/description', 'CRUD\DescriptionController@descriptionModal')->name('descriptionModal');
Route::post('/modal/link', 'CRUD\LinkController@linkModal')->name('linkModal');
Route::post('/modal/parking', 'CRUD\ParkingController@parkingModal')->name('parkingModal');
Route::post('/modal/delete', 'CRUD\DeleteController@deleteModal')->name('deleteModal');
Route::post('/modal/problem', 'CRUD\ProblemController@problemModal')->name('problemModal');
Route::post('/modal/sector', 'CRUD\SectorController@sectorModal')->name('sectorModal');

//CRUD AJAX
Route::resource('descriptions', 'CRUD\DescriptionController');
Route::resource('links', 'CRUD\LinkController');
Route::resource('crags', 'CRUD\CragController');
Route::resource('parkings', 'CRUD\ParkingController');
Route::resource('sectors', 'CRUD\SectorController');

//PROBLEM
Route::post('/send/problem', 'CRUD\ProblemController@sendProblem')->name('sendProblem');

//VUE CRAG
Route::get('/vue/crag/{crag_id}/map', 'Vue\CragVueController@vueMap')->name('vueMapCrag');
Route::get('/vue/crag/{crag_id}/fil-actu', 'Vue\CragVueController@vueFilActu')->name('vueFilActuCrag');
Route::get('/vue/crag/{crag_id}/medias', 'Vue\CragVueController@vueMedias')->name('vueMediasCrag');
Route::get('/vue/crag/{crag_id}/liens', 'Vue\CragVueController@vueLiens')->name('vueLiensCrag');
Route::get('/vue/crag/{crag_id}/topos', 'Vue\CragVueController@vueTopos')->name('vueToposCrag');
Route::get('/vue/crag/{crag_id}/secteur', 'Vue\CragVueController@vueSecteur')->name('vueSecteurCrag');

//VUE SECTEUR
Route::get('/vue/sector/{sector_id}/lines', 'Vue\SectorVueController@vueRoutes')->name('vueRoutesSector');
Route::get('/vue/sector/{sector_id}/descriptions', 'Vue\SectorVueController@vueDescriptions')->name('vueDescriptionsSector');
Route::get('/vue/sector/{sector_id}/photos', 'Vue\SectorVueController@vuePhotos')->name('vuePhotosSector');

//VUE ROUTE
Route::get('/vue/route/{route_id}/route','Vue\RouteVueController@vueRoute')->name('vueRouteRoute');
Route::get('/vue/route/{route_id}/information','Vue\RouteVueController@vueInformation')->name('vueInformationRoute');
Route::get('/vue/route/{route_id}/comments','Vue\RouteVueController@vueComments')->name('vueCommentsRoute');
Route::get('/vue/route/{route_id}/photos','Vue\RouteVueController@vuePhotos')->name('vuePhotosRoute');
Route::get('/vue/route/{route_id}/videos','Vue\RouteVueController@vueVideos')->name('vueVideosRoute');

//CHART
Route::get('/chart/crag/{crag_id}/grade', 'Chart\CragChartController@gradeChart')->name('gradeCragChart');
Route::get('/chart/crag/{crag_id}/climb', 'Chart\CragChartController@climbChart')->name('climbCragChart');
Route::get('/chart/sector/{sector_id}/grade', 'Chart\SectorChartController@gradeChart')->name('gradeSectorChart');
