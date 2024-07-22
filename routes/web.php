<?php

use App\Livewire\Dashboard\Employees\Index as EmployeesIndex;
use App\Livewire\Dashboard\Employees\Transactions\Index as EmployeeTransactionsIndex;
use App\Livewire\Dashboard\Expenses\Index as ExpensesIndex;
use App\Livewire\Dashboard\Families\Index as FamiliesIndex;
use App\Livewire\Dashboard\Families\Students\Index as FamilyStudentsIndex;
use App\Livewire\Dashboard\Groups\Index as GroupsIndex;
use App\Livewire\Dashboard\Home as Home;
use App\Livewire\Dashboard\Reports\Index as ReportsIndex;
use App\Livewire\Dashboard\Schools\Grades\Index as GradesIndex;
use App\Livewire\Dashboard\Schools\Index as SchoolsIndex;
use App\Livewire\Dashboard\Sessions\Create as SessionsCreate;
use App\Livewire\Dashboard\Sessions\Edit as SessionsEdit;
use App\Livewire\Dashboard\Sessions\Tags\Index as SessionsTagIndex;
use App\Livewire\Dashboard\Sessions\Index as SessionsIndex;
use App\Livewire\Dashboard\Sessions\Manage as SessionsManage;
use App\Livewire\Dashboard\Sessions\AdvancedSearch as SessionsAdvancedSearch;
use App\Livewire\Dashboard\Sessions\ShowCompleted as SessionsShowCompleted;
use App\Livewire\Dashboard\Sessions\PrintSession as SessionsPrint;
use App\Livewire\Dashboard\Settings\Index as SettingsIndex;
use App\Livewire\Dashboard\Students\Create as StudentsCreate;
use App\Livewire\Dashboard\Students\Index as StudentsIndex;
use App\Livewire\Dashboard\Students\Rates\Index as StudentsRateIndex;
use App\Livewire\Dashboard\Students\Sessions\Index as StudentSessionsIndex;
use App\Livewire\Dashboard\Students\Show as StudentsShow;
use App\Livewire\Dashboard\Students\Transactions\Index as StudentTransactionsIndex;
use App\Livewire\Dashboard\Subjects\Index as SubjectsIndex;
use App\Livewire\Dashboard\Subjects\Rates\BulkAssign as SubjectsBulkAssign;
use App\Livewire\Dashboard\Subjects\Rates\Index as SubjectsRateIndex;
use App\Livewire\Dashboard\Subjects\Tags\Index as SubjectsTagIndex;
use App\Livewire\Dashboard\Teachers\Index as TeachersIndex;
use App\Livewire\Dashboard\Teachers\Sessions\Index as TeacherSessionsIndex;
use App\Livewire\Dashboard\Teachers\Transactions\Index as TeacherTransactionsIndex;
use App\Livewire\Dashboard\Transactions\PrintTransaction as TransactionsPrint;
use App\Livewire\Dashboard\Users\Index as UsersIndex;
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

Route::middleware(['auth'])->group(function () {

    Route::get('/', Home::class)
        ->name('home');

    Route::prefix('dashboard')->as('dashboard.')->group(function () {

        Route::get('/', Home::class)
            ->name('dashboard.home');

        Route::get('/reports', ReportsIndex::class)
            ->middleware(['can:view reports'])
            ->name('reports.index');

        Route::get('/users', UsersIndex::class)->name('users.index')
            ->middleware(['can:manage users']);

        Route::middleware('can:manage subjects')->group(function () {

            Route::get('/subjects', SubjectsIndex::class)
                ->name('subjects.index');

            Route::get('/subjects/{subject}/rates', SubjectsRateIndex::class)
                ->name('subjects.rates.index');

            Route::get('/subjects/{subject}/tags', SubjectsTagIndex::class)
                ->name('subjects.tags.index');

            Route::get('/subjects/bulk-assign', SubjectsBulkAssign::class)
                ->name('subjects.bulk-assign');
        });

        Route::get('/expenses', ExpensesIndex::class)
            ->middleware(['can:manage expenses'])
            ->name('expenses.index');

        Route::middleware('can:manage sessions')->group(function () {
            Route::get('/sessions', SessionsIndex::class)->name('sessions.index');
            Route::get('/sessions/create', SessionsCreate::class)->name('sessions.create');
            Route::get('/sessions/{session}/edit', SessionsEdit::class)->name('sessions.edit');
            Route::get('/sessions/{session}/tags', SessionsTagIndex::class)->name('sessions.tags');
            Route::get('/sessions/{session}/manage', SessionsManage::class)->name('sessions.manage');
            Route::get('/sessions/advanced-search', SessionsAdvancedSearch::class)->name('sessions.advanced-search');
            Route::get('/sessions/{session}/show-completed', SessionsShowCompleted::class)->name('sessions.show-completed');
            Route::get('/sessions/{session}/print', SessionsPrint::class)->name('sessions.print');
        });

        Route::middleware('can:manage teachers')->group(function () {
            Route::get('/teachers', TeachersIndex::class)->name('teachers.index');
            Route::get('/teachers/{teacher}/transactions', TeacherTransactionsIndex::class)->name('teacher.transactions.index');
            Route::get('/teachers/{teacher}/sessions', TeacherSessionsIndex::class)->name('teacher.sessions.index');
        });

        Route::middleware('can:manage employees')->group(function () {
            Route::get('/employees', EmployeesIndex::class)->name('employees.index');
            Route::get('/employees/{employee}/transactions', EmployeeTransactionsIndex::class)->name('employee.transactions.index');
        });


        Route::get('/groups', GroupsIndex::class)
            ->middleware(['can:manage groups'])
            ->name('groups.index');


        Route::middleware('can:manage employees')->group(function () {
            Route::get('/schools', SchoolsIndex::class)->name('schools.index');
            Route::get('/schools/{school}/grades', GradesIndex::class)->name('grades.index');
        });

        Route::middleware('can:manage students')->group(function () {
            Route::get('/students/{student}/sessions', StudentSessionsIndex::class)->name('student.sessions.index');
            Route::get('/students/{student}/transactions', StudentTransactionsIndex::class)->name('student.transactions.index');
            Route::get('/students/{student}/rates', StudentsRateIndex::class)->name('student.rates.index');

            Route::get('/students', StudentsIndex::class)->name('students.index');
            Route::get('/students/create', StudentsCreate::class)->name('students.create');
            Route::get('/students/{student}', StudentsShow::class)->name('students.show');
        });


        Route::get('/transaction/{transaction}/print', TransactionsPrint::class)
            ->middleware('can:manage transactions')
            ->name('transactions.print');

        Route::middleware('can:manage families')->group(function () {
            Route::get('/families', FamiliesIndex::class)->name('families.index');
            Route::get('/families/{family}/students', FamilyStudentsIndex::class)->name('family.students.index');
        });

        Route::get('/settings', SettingsIndex::class)
            ->middleware('can:manage settings')
            ->name('settings.index');
    });

});


