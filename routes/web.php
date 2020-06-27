<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//auth area
$router->post('auth/login', 'AuthController@authenticate');
$router->post('auth/register', 'AuthController@register');
$router->post('fotografer/login', 'FotograferAuth@authenticate');

//crud fotografer
$router->get('/fotografers', 'FotograferController@list');
$router->get('/fotografer/{id}', 'FotograferController@detail');
$router->post('/fotografers', 'FotograferController@store');
$router->put('/fotografer/{id}', 'FotograferController@update');
$router->delete('/fotografer/{id}', 'FotograferController@destroy');

//crud school
$router->get('/schools', 'SchoolController@list');
$router->get('/school/{id}', 'SchoolController@detail');
$router->post('/schools', 'SchoolController@store');
$router->put('/school/{id}', 'SchoolController@update');
$router->delete('/school/{id}', 'SchoolController@destroy');

$router->get('school/{id}/list', 'ClassroomController@listBySchool');
//crud classroom
$router->get('/classrooms', 'ClassroomController@list');
$router->get('/classroom/{id}', 'ClassroomController@detail');
$router->post('/classrooms', 'ClassroomController@store');
$router->put('/classroom/{id}', 'ClassroomController@update');
$router->delete('/classroom/{id}', 'ClassroomController@destroy');

//crud schedule
$router->get('/schedules', 'ScheduleController@list');
$router->get('/schedule/{id}', 'ScheduleController@detail');
$router->post('/schedules', 'ScheduleController@store');
$router->put('/schedule/{id}', 'ScheduleController@update');
$router->delete('/schedule/{id}', 'ScheduleController@destroy');

$router->get('/schedule/{id}/picked', 'ScheduleController@listByPicked');

//crud Input
$router->get('/inputs', 'InputController@list');
$router->get('/input/{id}', 'InputController@detail');
$router->post('/inputs', 'InputController@store');
$router->put('/input/{id}', 'InputController@update');
$router->delete('/input/{id}', 'InputController@destroy');

$router->get('/input/{id}/inputed', 'InputController@listPicked');

//jwt auth
$router->group(
    ['middleware' => 'jwt.auth'],
    function() use ($router) {
        $router->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });

        $router->post('test', function () {
            return "CEK";
        });
    }
);


// Generate Key jwt & app
// $router->get('/key', function() {
//     return \Illuminate\Support\Str::random(32);
// });
