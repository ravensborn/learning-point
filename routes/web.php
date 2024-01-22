<?php

use App\Livewire\Dashboard\Home as Home;
use App\Livewire\Dashboard\Users\Index as UsersIndex;

use App\Livewire\Dashboard\Subjects\Index as SubjectsIndex;

use App\Livewire\Dashboard\Sessions\Index as SessionsIndex;
use App\Livewire\Dashboard\Sessions\Create as SessionsCreate;
use App\Livewire\Dashboard\Sessions\Manage as SessionsManage;

use App\Livewire\Dashboard\Teachers\Index as TeachersIndex;
use App\Livewire\Dashboard\Teachers\Transactions\Index as TeacherTransactionsIndex;

use App\Livewire\Dashboard\Employees\Index as EmployeesIndex;
use App\Livewire\Dashboard\Employees\Transactions\Index as EmployeeTransactionsIndex;

use App\Livewire\Dashboard\Subjects\Rates\Index as SubjectsRateIndex;
use App\Livewire\Dashboard\Groups\Index as GroupsIndex;
use App\Livewire\Dashboard\Schools\Index as SchoolsIndex;
use App\Livewire\Dashboard\Schools\Grades\Index as GradesIndex;
use App\Livewire\Dashboard\Students\Index as StudentsIndex;
use App\Livewire\Dashboard\Students\Create as StudentsCreate;
use App\Livewire\Dashboard\Students\Show as StudentsShow;
use App\Livewire\Dashboard\Students\Transactions\Index as StudentTransactionsIndex;
use App\Livewire\Dashboard\Students\Rates\Index as StudentsRateIndex;

use App\Livewire\Dashboard\Transactions\PrintTransaction as TransactionsPrint;

use App\Livewire\Dashboard\Families\Index as FamiliesIndex;
use App\Livewire\Dashboard\Families\Students\Index as FamilyStudentsIndex;


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

        Route::get('/sessions', SessionsIndex::class)->name('sessions.index');
        Route::get('/sessions/create', SessionsCreate::class)->name('sessions.create');
        Route::get('/sessions/{session}/manage', SessionsManage::class)->name('sessions.manage');

        Route::get('/teachers', TeachersIndex::class)->name('teachers.index');
        Route::get('/teachers/{teacher}/transactions', TeacherTransactionsIndex::class)->name('teacher.transactions.index');

        Route::get('/employees', EmployeesIndex::class)->name('employees.index');
        Route::get('/employees/{employee}/transactions', EmployeeTransactionsIndex::class)->name('employee.transactions.index');

        Route::get('/subjects/{subject}/rates', SubjectsRateIndex::class)->name('subjects.rates.index');

        Route::get('/groups', GroupsIndex::class)->name('groups.index');

        Route::get('/schools', SchoolsIndex::class)->name('schools.index');
        Route::get('/schools/{school}/grades', GradesIndex::class)->name('grades.index');

        Route::get('/students/{student}/transactions', StudentTransactionsIndex::class)->name('student.transactions.index');
        Route::get('/students/{student}/rates', StudentsRateIndex::class)->name('student.rates.index');

        Route::get('/transaction/{transaction}/print', TransactionsPrint::class)->name('transactions.print');

        Route::get('/students', StudentsIndex::class)->name('students.index');
        Route::get('/students/create', StudentsCreate::class)->name('students.create');
        Route::get('/students/{student}', StudentsShow::class)->name('students.show');

        Route::get('/families', FamiliesIndex::class)->name('families.index');
        Route::get('/families/{family}/students', FamilyStudentsIndex::class)->name('family.students.index');
    });

});


