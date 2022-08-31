<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function (Request $request) {
    $request->session()->put('state', $state = Str::random(40));
    $query = http_build_query([
        'client_id' => "97273026-3655-409e-9eec-b93fc3ca5147",
        "redirect_uri" => 'http://127.0.0.1:8080/callback',
        'response_type' => "code",
        "scope" => "",
        "state" => $state
    ]);
    return redirect("http://127.0.0.1:8000/oauth/authorize?" . $query);
});

Route::get("/callback", function (Request $request) {
    $state = $request->session()->pull('state');

    throw_unless(strlen($state) > 0 && $state == $request->state, InvalidArgumentException::class);

    $response = \Illuminate\Support\Facades\Http::asForm()->post([]);
});
