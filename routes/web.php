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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('pages/home');
});

Route::get('/apply', function () {
    return view('pages/apply');
});

Route::get('/fourofour', function () {
    return view('pages/fourofour');
});

//Route::get('/skills', function () {
//    return view('pages/graph');
//});

Route::get('/legal', function () {
    return view('pages/legal');
});


Route::get('/project', ['uses' => 'UsersController@project']);

Route::match(['get', 'post'],'/contact', [
    'as'=>'home.contact',
    'uses' => 'HomeController@contact'
]);

Route::match(['get', 'post'],'/apply', [
    'as'=>'pages.apply',
    'uses' => 'EditorController@create'
]);

Route::get('/profile', ['uses' => 'UsersController@profile']);

Route::match(['get', 'post'],'/profile/edit/{id}', [
    'as'=>'pages.edit_profile',
    'uses' => 'UsersController@profileUpdate'
]);

Route::get('/edit', function () {
    return view('pages/editor/editor_dashboard');
});

Route::match(['get', 'post'],'/change_password/{id}', [
    'as' => 'pages.change_password',
    'uses' => 'UsersController@changePassword'
]);

//Route::get('/graph', ['uses' => 'GraphController@graphAction']);
Route::get('/skills', ['uses' => 'GraphController@graphAction']);

Route::get('/export', ['uses' => 'DumpController@generateDumpAction']);

Route::get('/users', ['uses' => 'UsersController@index']);
Route::get('/editors_requests', ['uses' => 'EditorController@index']);
Route::get('/skill_requests', ['uses' => 'SkillController@index']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/maintenance', function () {
    return view('maintenance');
});

//Route::get('scripts/js-translations.js', ['uses' => 'GraphController@getJSTranslationsAction']);

Route::get('/api/getNodeChildren/{uuid}', [
//    'as'=>'pages.edit_profile',
    'uses' => 'ApiController@getNodeChildrenAction'
]);

Route::get('/panel/getPanel/{uuid}', [
    'uses' => 'PanelContoller@getPanelAction'
]);

//Route::get('/panel/{uuid}', [
//    'uses' => 'PanelController@getPanelAction'
//]);

Route::post('api/renameSkill', [
    'uses' => 'ApiController@getPanelAction'
]);


Route::post('api/addSkill', [
    'uses' => 'ApiController@getPanelAction'
]);

Route::get('goTo/{slug}', [
    'as' => 'goToSlug',
    'uses' => 'GraphController@goToAction'
]);

Route::get('skillHistory', [
    'uses' => 'ApiController@skillHistoryAction'
]);