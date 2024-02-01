<?php

namespace App\Livewire\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Models\Attendee;
use App\Models\Group;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{

    public SessionForm $sessionForm;

    public $availableTeachers;
    public $availableSubjects;
    public $availableTypes;

    public string $studentSearchQuery = '';
    public $foundStudents;
    public $students;


    public function store(): void
    {
        $this->sessionForm->user_id = auth()->user()->id;
        $model = $this->sessionForm->store();

        $this->storeAttendees($model->id);

        $this->redirectRoute('dashboard.sessions.manage', $model->id);
    }

    public function storeAttendees($sessionId): void
    {
        foreach ($this->students as $student) {

            [$amount, $note] = Attendee::calculateStudentCharge($this->sessionForm->subject_id, $student->studentRates, $this->students->count());

            $chargeList[] = [
                'name' => 'Session Charge',
                'amount' => $amount,
                'rated' => true,
                'note' => $note,
                'managed' => true,
            ];

            Attendee::create([
                'session_id' => $sessionId,
                'student_id' => $student->id,
                'attending' => true,
                'charged' => true,
                'charge_list' => $chargeList,
                'cancellation_charge_list' => [],
            ]);

            $chargeList = [];
        }
    }


    public function updatedSessionFormTimeIn(): void
    {
        $this->sessionForm->time_out = $this->sessionForm->time_in;
    }

    public function addStudent($id): void
    {
        $student = $this->foundStudents->find($id);

        if ($student) {
            if (!$this->students->contains('id', '=', $student->id)) {
                $this->students->push($student);
            }
        }

    }


    public function removeStudent($id): void
    {
        $this->students = $this->students->filter(function ($student) use ($id) {
            return $student->id != $id;
        });
    }

    public function updatedStudentSearchQuery(): void
    {
        $this->foundStudents = Student::whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->studentSearchQuery) . "%' ")
            ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->studentSearchQuery) . '%')
            ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->studentSearchQuery) . '%')
            ->orWhere('email', 'LIKE', '%' . trim($this->studentSearchQuery) . '%')
            ->limit(5)
            ->get();
    }

    public function mount(): void
    {

        $this->availableTeachers = Teacher::orderBy('name')->get();
        $this->availableSubjects = Group::with([
            'subjects' => function ($query) {
                $query->orderBy('name');
            }
        ])->where('model', Subject::class)
            ->get()
            ->filter(function ($group) {
                if ($group->subjects->count()) {
                    return $group;
                }
            });


        $this->availableTypes = Session::TYPES;
        $this->foundStudents = collect();
        $this->students = collect();

    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.sessions.create');
    }

}
