<?php

use App\Models\Post;
use App\Models\User;
use App\Enums\PostState;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Process;
use App\Http\Controllers\PostController;
use Laravel\Pennant\Feature;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

auth()->onceUsingId(3);
// auth()->loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dash', function () {
    if(Feature::active('dashboard-v2')) {
        return redirect('/new-dashboard');
    }

    return 'dashboard';
});


Route::get('/new-dashboard', function () {
    return 'new-dashboard';
})->middleware('feature:dashboard-v2');
