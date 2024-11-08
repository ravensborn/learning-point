<?php

namespace App\Livewire\Teachers\Dashboard\Sessions;

use App\Livewire\Forms\SessionForm;
use App\Models\Attendee;
use App\Models\Group;
use App\Models\Session;
use App\Models\Student;
use App\Models\Subject;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Create extends Component
{

    public SessionForm $sessionForm;
    public $availableSubjects;
    public $availableTypes;

    public string $studentSearchQuery = '';
    public $foundStudents;
    public array $nonAttendingStudentIds = [];
    public $students;


    public function toggleStudentAttending($studentId): void
    {
        if (in_array($studentId, $this->nonAttendingStudentIds)) {
            foreach ($this->nonAttendingStudentIds as $key => $id) {
                if ($id == $studentId) {
                    unset($this->nonAttendingStudentIds[$key]);
                }
            }
        } else {
            $this->nonAttendingStudentIds[] = $studentId;
        }
    }

    public function store(): void
    {
        $this->sessionForm->user_id = null;
        $this->sessionForm->teacher_id = auth()->guard('teacher')->user()->id;
        $this->sessionForm->created_by = 'Teacher: ' . auth()->guard('teacher')->user()->name;


        $model = $this->sessionForm->store();

        $this->storeAttendees($model->id);

        $this->redirectRoute('teacher.dashboard.sessions.index');
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

            $attending = true;
            if (in_array($student->id, $this->nonAttendingStudentIds)) {
                $attending = false;
            }

            Attendee::create([
                'session_id' => $sessionId,
                'student_id' => $student->id,
                'attending' => $attending,
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
        $search = trim($this->studentSearchQuery);
        $this->foundStudents = Student::whereRaw("concat(trim(first_name), ' ', trim(middle_name), ' ', trim(last_name)) like ?", ["%{$search}%"])
            ->orWhere('primary_phone_number', 'LIKE', '%' . $search . '%')
            ->orWhere('secondary_phone_number', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->limit(5)
            ->get();
    }

    public function mount(): void
    {


        $this->availableSubjects = Group::with([
            'subjects' => function ($query) {
                $query->orderBy('name');
            }
        ])->where('model', Subject::class)
            ->orderBy('name')
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

    #[Layout('layouts.teachers-dashboard')]
    public function render()
    {
        return view('livewire.teachers.dashboard.sessions.create');
    }

}
