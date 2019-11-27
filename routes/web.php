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

use App\Task;
use Illuminate\Http\Request;


Route::get('/', 'FlatshareMainController@index')->name('dashboard');

Route::prefix('/flatshare')->group(function() {

    Route::get('choice', 'FlatshareChoiceController@index')->name('flatsharechoiceoptions');
    Route::get('join', 'FlatshareChoiceController@join')->name('flatsharechoicejoin');
    Route::get('create', 'FlatshareChoiceController@create')->name('flatsharechoicecreate');

});

Route::get('/profile', 'ProfileController@index')->name('profile');

/**
 * Display All Tasks
 */
Route::get('/list', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
});

/**
 * Add A New Task
 */
Route::post('/list/task', function (Request $request) {
    /* $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
    ]);

    if ($validator->fails()) {
        return redirect('/list')
            ->withInput()
            ->withErrors($validator);
    } */

    $task = new Task;
    $task->name = $request->name;
    $task->save();

    return redirect('/list');
});

/**
 * Delete An Existing Task
 */
Route::delete('/list/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/list');
});

Auth::routes();

