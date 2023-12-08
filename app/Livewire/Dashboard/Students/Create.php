<?php

namespace App\Livewire\Dashboard\Students;

use App\Livewire\Forms\StudentContactForm;
use App\Livewire\Forms\StudentForm;
use App\Models\City;
use App\Models\Grade;
use App\Models\School;
use App\Models\StudentContact;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Validator;

class Create extends Component
{

    use WithFileUploads;

    public StudentForm $studentForm;
    public StudentContactForm $studentContactForm;

    public $availableCities;
    public $availableAcademicStreams;
    public $availableSchools;
    public $availableGrades;

    public function updatedStudentFormSchoolId(): void
    {
        $this->availableGrades = Grade::where('school_id', $this->studentForm->school_id)->get();
    }

    public string $step = 'welcome';

    public $cities;
    public $studentContacts;

    public function storeStudent(): void
    {
        $this->studentForm->user_id = auth()->user()->id;
        $this->studentForm->store();
        $this->setStep('profile-picture');
    }

    private function validateStudentSchool(): void
    {
        $data = [
            'student_id' => $this->studentForm->model->student_id,
            'school_id' => $this->studentForm->school_id,
            'grade_id' => $this->studentForm->grade_id,
            'academic_stream' => $this->studentForm->academic_stream,
            'school_username' => $this->studentForm->school_username,
            'school_password' => $this->studentForm->school_password,
        ];

        $rules = [
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'grade_id' => ['required', 'integer', 'exists:grades,id'],
            'academic_stream' => ['required', 'string', 'in:' . implode(',', array_keys(School::ACADEMIC_STREAMS))],
            'school_username' => ['required', 'string', 'min:1', 'max:50'],
            'school_password' => ['required', 'string', 'min:1', 'max:50'],
        ];

        $attributes = [
            'school_id' => 'school',
            'grade_id' => 'grade',
            'academic_stream' => 'academic stream',
            'school_username' => 'school username',
            'school_password' => 'school password',
        ];

        $validator = Validator::make(data: $data, rules: $rules, attributes: $attributes)
            ->validate();
    }

    public function storeStudentSchool(): void
    {

        $this->validateStudentSchool();
//        $this->studentForm->user_id = auth()->user()->id;
        $this->studentForm->update();
        $this->setStep('contacts');
    }

    public function setStep($step = 'welcome'): void
    {
        $this->step = $step;
    }

    public function updatedStudentFormAvatar(): void
    {
        $this->validateOnly('studentForm.avatar', attributes: [
            'studentForm.avatar' => 'avatar'
        ]);

        $this->studentForm->setProfilePicture();
    }

    public function resetProfilePicture(): void
    {
        $this->studentForm->resetProfilePicture();
        $this->studentForm->avatar = null;
    }

    public function storeStudentContact(): void
    {
        $this->studentContactForm->student_id = $this->studentForm->model->id;
        $this->studentContactForm->store();
        $this->loadStudentContacts();
        $this->studentContactForm->reset();
    }

    public function deleteStudentContact($id): void
    {
        $contact = StudentContact::where('student_id', $this->studentForm->model->id)->find($id);
        if ($contact) {
            $contact->delete();
        }
        $this->loadStudentContacts();
    }

    public function loadStudentContacts(): void
    {
        $this->studentContacts = StudentContact::where('student_id', $this->studentForm->model->id)->get();
    }

    public function updateStudentSchool(): void
    {


        $this->setStep('contacts');

    }

    public function mount(): void
    {

        $this->availableAcademicStreams = School::ACADEMIC_STREAMS;
        $this->studentContacts = collect();
        $this->availableCities = City::all();
        $this->availableGrades = collect();
        $this->availableSchools = School::all();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.students.create');
    }


}
