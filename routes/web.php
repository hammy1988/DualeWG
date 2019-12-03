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


Route::get('/', 'View\FlatshareViewController@index')->name('dashboard');

Route::prefix('/flatshare')->group(function() {

    Route::middleware('checkNoFlatshareRequest')->get('choice', 'View\FlatshareChoiceViewController@index')->name('flatsharechoiceoptions');
    Route::middleware('checkNoFlatshareRequest')->get('join', 'View\FlatshareChoiceViewController@join')->name('flatsharechoicejoin');
    Route::middleware('checkNoFlatshareRequest')->get('create', 'View\FlatshareChoiceViewController@create')->name('flatsharechoicecreate');
    Route::middleware('checkFlatshareRequest')->get('request', 'View\FlatshareChoiceViewController@request')->name('flatsharerequest');


});

Route::prefix('/management')->group(function() {

    Route::get('profile', 'View\UserViewController@index')->name('profile');
    Route::get('flatshare', 'View\FlatshareViewController@flatsharemanagemeint')->name('flatsharemanagement');
    Route::get('profilepassword', 'View\UserViewController@password')->name('profilepassword');

});


/**
 * Display All Tasks
 */
Route::get('/grocerylist', function () {
    $tasks = Task::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'tasks' => $tasks
    ]);
})->name('grocerylist');

/**
 * Add A New Task
 */
Route::post('/grocerylist/task', function (Request $request) {
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
    $task->menge = $request->menge;
    $task->save();

    return redirect('/grocerylist');
});

/**
 * Delete An Existing Task
 */
Route::delete('/grocerylist/task/{id}', function ($id) {
    Task::findOrFail($id)->delete();

    return redirect('/grocerylist');
});

Auth::routes();

