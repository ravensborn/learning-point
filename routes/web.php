<?php

use App\Livewire\Dashboard\Home as Home;
use App\Livewire\Dashboard\Users\Index as UsersIndex;
use App\Livewire\Dashboard\Subjects\Index as SubjectsIndex;
use App\Livewire\Dashboard\Groups\Index as GroupsIndex;
use App\Livewire\Dashboard\Students\Index as StudentsIndex;


use Illuminate\Support\Facades\Auth;
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


Auth::routes([
    'register' => false,
    'logout' => false,
]);

Route::get('logout', function () {

    auth()->logout();

    return redirect()->route('login');

})->name('logout');

Route::middleware(['auth'])->group(function() {

    Route::get('/', Home::class)->name('home');

    Route::prefix('dashboard')->as('dashboard.')->group(function () {

        Route::get('/', Home::class)->name('dashboard.home');

        Route::get('/users', UsersIndex::class)->name('users.index');
        Route::get('/subjects', SubjectsIndex::class)->name('subjects.index');
        Route::get('/groups', GroupsIndex::class)->name('groups.index');
        Route::get('/students', StudentsIndex::class)->name('students.index');

    });

});


