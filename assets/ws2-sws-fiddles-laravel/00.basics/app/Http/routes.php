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

use Illuminate\Http\Request;
use App\Todo;

// BASIC ROUTING

Route::get('/', function () {
    return 'Homepage';
});

Route::get('foo', function () {
    return 'Hello World';
});

// DYNAMIC ROUTING + REGEX CONSTRAINTS

Route::get('users/{id}/{name?}', function ($id, $name = 'John') {
    return 'Welcome ' . $name;
})
->where(['id' => '[0-9]+', 'name' => '[a-zA-Z]+']);

// ACCESSING THE REQUEST

Route::any('demo/request', function(Request $request) {
	$info[] = 'Your IP: ' . $request->ip();
	$info[] = 'Request method: ' . $request->method();
	$info[] = 'Your name cookie: ' . $request->cookie('name');
    return implode('<br/>', $info);
});

// ACCESSING THE RESPONSE

Route::get('demo/cookie/{name?}', function ($name = 'John') {
	return response('Welcome ' . $name)
                ->cookie('name', $name);
});

// REDIRECT

Route::get('demo/redirect', function () {
	return redirect('/');
});


// TWO TYPES OF VIEWS

Route::get('demo/views', function () {
	return view('fruit', ['fruits' => ['apple' => 1.25, 'strawberry' => 6.50, 'lime' => 0.65]]);
});

Route::get('demo/blade', function () {
	return view('fruit2', ['fruits' => ['apple' => 1.25, 'strawberry' => 6.50, 'lime' => 0.65]]);
});

// RAW QUERIES

Route::get('demo/raw/{id}', function ($id) {
	$todos = DB::select('select * from todolist where user_id = ? ', [$id]);
	$output = '';
	foreach ($todos as $todo) {
		$output .= ('<b>' . $todo->priority . ':</b> ' . $todo->what . '<br/>');
	}
	return $output;
})
->where(['id' => '[0-9]+']);

// QUERY BUILDER

Route::get('demo/qb/{id}', function ($id) {
	$todos = DB::table('todolist')->where('user_id', $id)->get();
	$output = '';
	foreach ($todos as $todo) {
		$output .= ('<b>' . $todo->priority . ':</b> ' . $todo->what . '<br/>');
	}
	return $output;
})
->where(['id' => '[0-9]+']);


// ELOQUENT ORM

Route::get('demo/eloquent/{id}', function ($id) {
	$todos = Todo::where('user_id', $id)->get();
	$output = '';
	foreach ($todos as $todo) {
		$output .= ('<b>' . $todo->priority . ':</b> ' . $todo->what . '<br/>');
	}
	return $output;
})
->where(['id' => '[0-9]+']);


// ELOQUENT ORM: ACTIVE RECORD DEMO

Route::get('demo/addx/{id}', function ($id) {
	$todo = Todo::find($id);
	$todo->what .= 'x';
	$todo->save();
	return redirect('demo/eloquent/' . $todo->user_id);
})
->where(['id' => '[0-9]+']);
