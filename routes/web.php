<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

if(env('APP_ENV') === 'production') {
    URL::forceSchema('https');
}


Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', 'HomeController@index')->name('chart');
    Route::get('/home', 'HomeController@index');
    Route::get('/help', function () {
        return view('uitleg');
    });

    Route::resource('tasks', 'TaskController');
    Route::resource('users', 'UserController');
    Route::resource('resources', 'ResourceController');
    Route::resource('departments', 'DepartmentController');
    Route::resource('tags', 'TagController');

    Route::post('departments/{id}/setAsCurrentDepartment', 'DepartmentController@setAsCurrentDepartment')->name('setCurrentDepartment');
    Route::post('tasks/{id}/dependency', 'TaskController@createDependency')->name('tasks.createDependency');
    Route::delete('dependencies/{id1}/{id2}', 'TaskController@destroyDependency')->name('tasks.deleteDependency');

    Route::get('/data/tasks', 'TaskController@indexData')->name('tasks.data');
});

