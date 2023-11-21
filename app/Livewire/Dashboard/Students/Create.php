<?php

namespace App\Livewire\Dashboard\Students;

use App\Livewire\Forms\StudentContactForm;
use App\Livewire\Forms\StudentForm;
use App\Livewire\Forms\StudentSchoolForm;
use App\Models\City;
use App\Models\StudentContact;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public StudentForm $studentForm;
    public StudentSchoolForm $studentSchoolForm;
    public StudentContactForm $studentContactForm;

    public string $step = 'welcome';

    public $cities;
    public $studentContacts;

    public function storeStudent(): void
    {
        $this->studentForm->store();
        $this->setStep('profile-picture');
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

    public function storeStudentSchool(): void
    {

        $this->studentSchoolForm->student_id = $this->studentForm->model->id;

        $this->studentSchoolForm->store();

        $this->setStep('contacts');

    }

    public function mount(): void
    {

        $this->studentContacts = collect();
        $this->cities = City::all();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.students.create');
    }


}
