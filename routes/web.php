<?php
use Auth0\Laravel\Facade\Auth0;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Welcome Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // If user is logged in, show their name/email directly
    if (auth()->check()) {
        $user = auth()->user();
        return response("Hello {$user->name}! Your email is {$user->email}. <a href='/logout'>Logout</a>");
    }

    // If not logged in, show the welcome view with a login link
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Protected Route (The "Private" Page)
|--------------------------------------------------------------------------
*/
Route::get('/private', function () {
    // Only accessible if logged in
    return "This is a private secret! Only for " . auth()->user()->name;
})->middleware('auth');