<?php

namespace App\Livewire\Dashboard\Students;

use App\Livewire\Forms\StudentContactForm;
use App\Livewire\Forms\StudentForm;
use App\Livewire\Forms\StudentSchoolForm;
use App\Models\City;
use App\Models\Student;
use App\Models\StudentContact;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{

    use WithFileUploads;

    public Student $student;
    public StudentForm $studentForm;
    public StudentContactForm $studentContactForm;
    public StudentSchoolForm $studentSchoolForm;
    public $contacts;
    public $availableRelations;
    public $availableAcademicStreams;
    public $availableCities;

    public bool $showStudentSchoolAccountPassword = false;

    public $selectedContact;
    public $deleteContactButtonText = 'Delete contact';
    public int $deletingContactId = 0;
    public bool $updateAvatarMode = false;




    public function toggleStudentSchoolAccountPassword(): void
    {
        $this->showStudentSchoolAccountPassword = !$this->showStudentSchoolAccountPassword;
    }

    public function deleteContact($contactId = 0): void
    {
        if($this->deletingContactId == $contactId) {

            $contact = $this->contacts->find($contactId);

            if($contact) {
                $contact->delete();
                $this->loadContacts();
                $this->deletingContactId = 0;
                $this->selectedContact = null;
                $this->dispatch('close-all-modals');
            }

        } else {
            $this->deletingContactId = $contactId;
            $this->deleteContactButtonText = 'Are you sure?';
        }
    }
    public function resetShowContactModal(): void
    {
        $this->deletingContactId = 0;
        $this->deleteContactButtonText = 'Delete contact';
    }

    public function showContactModal($contactId): void
    {
        $this->selectedContact = $this->contacts->find($contactId);
        $this->dispatch('toggle-modal-show-contact');
    }

    public function showStudentUpdateModal(): void
    {
        $this->dispatch('toggle-modal-update-student');
    }
    public function prepareStudentUpdate(): void
    {
        $this->studentForm->setup($this->student->id);
        $this->dispatch('toggle-modal-edit-student');
    }
    public function updateStudent(): void
    {
        $this->studentForm->update();
        $this->dispatch('close-all-modals');
        $this->reloadStudent();
    }
    public function resetStudentEditForm(): void
    {
        $this->studentForm->reset();
        $this->studentForm->setup($this->student->id);
        $this->resetValidation();
    }

    public function showContactCreateModal(): void
    {
        $this->dispatch('toggle-modal-create-contact');
    }
    public function storeContact(): void
    {
        $this->studentContactForm->student_id = $this->student->id;
        $this->studentContactForm->store();
        $this->loadContacts();
        $this->studentContactForm->reset();
        $this->dispatch('close-all-modals');
    }

    public function showSchoolCreateModal(): void
    {
        $this->dispatch('toggle-modal-create-school');
    }

    public function createSchoolEntry(): void
    {
        $this->student->school()->create();
        $this->prepareSchoolUpdate();
    }
    public function prepareSchoolUpdate(): void
    {
       if($this->student->school) {
           $this->studentSchoolForm->setup($this->student->school->id);
           $this->dispatch('toggle-modal-edit-school');
       }
    }
    public function updateSchool(): void
    {
        $this->studentSchoolForm->update();
        $this->dispatch('close-all-modals');
    }
    public function resetSchoolEditForm(): void
    {
        $this->resetValidation();
        $this->studentSchoolForm->reset();
        $this->studentSchoolForm->setup($this->student->school->id);
    }

    public function showStudentAvatarModal(): void
    {
        $this->studentForm->setup($this->student->id);
        $this->dispatch('toggle-modal-show-student-avatar');
    }

    public function toggleUpdateAvatarMode(): void
    {
        $this->updateAvatarMode = !$this->updateAvatarMode;
    }

    public function updatedStudentFormAvatar(): void
    {
//        $this->validateOnly('studentForm.avatar', attributes: [
//            'studentForm.avatar' => 'avatar'
//        ]);
        $this->resetValidation();
    }

    public function saveStudentAvatar(): void
    {

        $this->validateOnly('studentForm.avatar', attributes: [
            'studentForm.avatar' => 'avatar'
        ]);

        $this->studentForm->setProfilePicture();
        $this->updateAvatarMode = false;
        $this->reloadStudent();
    }

    public function loadContacts(): void
    {
        $this->contacts = StudentContact::where('student_id', $this->student->id)->get();
    }

    public function reloadStudent(): void
    {
        $this->student = Student::findOrFail($this->student->id);
    }

    public function mount(Student $student): void
    {
        $this->student = $student;
        $this->availableRelations = StudentContact::AVAILABLE_RELATIONS;
        $this->availableAcademicStreams = Student::ACADEMIC_STREAMS;
        $this->availableCities = City::all();
        $this->loadContacts();
    }

    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.dashboard.students.show');
    }

}
