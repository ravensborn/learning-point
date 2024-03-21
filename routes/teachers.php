<?php

use App\Livewire\Teachers\Dashboard\Home;
use App\Livewire\Teachers\Dashboard\Login;

use App\Livewire\Teachers\Dashboard\Sessions\Index as SessionsIndex;
use App\Livewire\Teachers\Dashboard\Sessions\Create as SessionsCreate;
use App\Livewire\Teachers\Dashboard\Sessions\Edit as SessionsEdit;

use Illuminate\Support\Facades\Route;

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

Route::get('logout', function () {

    auth()->guard('teacher')->logout();

    return redirect()->route('teacher.login');

})->name('logout');


Route::get('/login', Login::class)->name('login');

Route::middleware(['auth-teacher'])->prefix('dashboard')->as('dashboard.')->group(function() {

    Route::get('/', Home::class)->name('home');

    Route::get('/sessions', SessionsIndex::class)->name('sessions.index');
    Route::get('/sessions/create', SessionsCreate::class)->name('sessions.create');
    Route::get('/sessions/{session}/edit', SessionsEdit::class)->name('sessions.edit');

});


