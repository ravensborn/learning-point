<?php

namespace App\Traits;

use App\Models\Family;
use App\Models\School;
use App\Models\StudentContact;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Validator;

trait StudentShowModalFunctions
{

    //Contacts
    public function storeContact(): void
    {
        $this->studentContactForm->student_id = $this->student->id;
        $this->studentContactForm->store();
        $this->loadContacts();
        $this->dispatch('close-all-modals');
    }

    public int $deletingContactId = 0;

    public function deleteContact($contactId = 0): void
    {
        if ($this->deletingContactId == $contactId) {

            $contact = $this->contacts->find($contactId);

            if ($contact) {
                $contact->delete();
                $this->loadContacts();
                $this->deletingContactId = 0;
                $this->dispatch('close-all-modals');
            }

        } else {
            $this->deletingContactId = $contactId;
        }
    }

    public function showContactModal($contactId): void
    {
        $this->selectedContact = $this->contacts->find($contactId);
        $this->dispatch('toggle-modal-show-contact');
    }

    public function showContactCreateModal(): void
    {
        $this->dispatch('toggle-modal-create-contact');
    }

    public function resetContactCreateModal(): void
    {
        $this->studentContactForm->reset();
        $this->resetValidation();
    }

    public StudentContact $editingContactModel;

    public function showContactEditModal($contactId): void
    {
        $this->editingContactModel = $this->contacts->find($contactId);
        $this->studentContactForm->setup($contactId);
        $this->dispatch('toggle-modal-edit-contact');
    }

    public function updateContact(): void
    {
        $this->studentContactForm->update();
        $this->loadContacts();
        $this->dispatch('toggle-modal-edit-contact');
    }

    public function resetContactEditModal(): void
    {
        $this->studentContactForm->reset();
        $this->resetValidation();
    }


    //Student Information
    public function updateStudent(): void
    {
        $this->studentForm->user_id = $this->student->user_id;
        $this->studentForm->update();
        $this->dispatch('close-all-modals');
        $this->reloadStudent();
    }

    public function showStudentEditModal(): void
    {
        $this->studentForm->setup($this->student->id);
        $this->dispatch('toggle-modal-edit-student');
    }

    public function resetStudentEditModel(): void
    {
        $this->studentForm->reset();
        $this->studentForm->setup($this->student->id);
        $this->resetValidation();
    }

    //Student Family

    public string $searchFamilyQuery = '';

    public function updatedSearchFamilyQuery(): void
    {
        if ($this->searchFamilyQuery) {

            $this->availableFamilies = Family::where('name', 'LIKE', '%' . trim($this->searchFamilyQuery) . '%')
                ->orWhere('number', 'LIKE', '%' . trim($this->searchFamilyQuery) . '%')
                ->orWhereHas('students', function ($query) {
                    $query->whereRaw("concat(first_name, ' ', middle_name, ' ', last_name) like '%" . trim($this->searchFamilyQuery) . "%' ")
                        ->orWhere('primary_phone_number', 'LIKE', '%' . trim($this->searchFamilyQuery) . '%')
                        ->orWhere('secondary_phone_number', 'LIKE', '%' . trim($this->searchFamilyQuery) . '%')
                        ->orWhere('email', 'LIKE', '%' . trim($this->searchFamilyQuery) . '%');
                })->limit(10)->get();

        } else {
            $this->availableFamilies = Family::orderBy('created_at', 'desc')->get();
        }
    }
    private function validateStudentFamily(): void
    {

        $data = [
            'family_id' => $this->studentForm->family_id,
        ];

        $rules = [
            'family_id' => ['nullable', 'integer', 'exists:families,id'],
        ];

        $attributes = [
            'family_id' => 'family',
        ];

        $validator = Validator::make(data: $data, rules: $rules, attributes: $attributes)
            ->validate();
    }
    public function updateStudentFamily(): void
    {
        $this->validateStudentFamily();
        $this->studentForm->user_id = $this->student->user_id;
        $this->studentForm->update();
        $this->dispatch('close-all-modals');
        $this->reloadStudent();
        $this->loadFamily();
    }

    public function showStudentFamilyEditModal(): void
    {
        $this->studentForm->setup($this->student->id);
        $this->dispatch('toggle-modal-edit-student-family');
    }

    public function resetStudentFamilyEditModel(): void
    {
        $this->searchFamilyQuery = '';
        $this->studentForm->reset();
        $this->studentForm->setup($this->student->id);
        $this->resetValidation();
    }

    //School Information
    public function showSchoolEditModal(): void
    {
        $this->studentForm->setup($this->student->id);
        $this->dispatch('toggle-modal-edit-school');
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

    public function updateSchool(): void
    {
        $this->validateStudentSchool();
        $this->studentForm->user_id = $this->student->user_id;
        $this->studentForm->update();
        $this->dispatch('close-all-modals');
    }

    public function resetSchoolEditModal(): void
    {
        $this->studentForm->reset();
        $this->studentForm->setup($this->student->id);
        $this->resetValidation();
    }


    //Student Avatar
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


    //Upload document

    public $document;
    public string $document_name = '';

    public function showDocumentUploadModal(): void
    {
        $this->document = null;
        $this->document_name = '';
        $this->resetValidation();
        $this->dispatch('toggle-modal-upload-document');
    }

    public function saveDocument(): void
    {
        $this->validate([
            'document' => 'required|file|mimes:jpg,png,pdf|max:' . 1024 * 10,
            'document_name' => 'required|string|max:50',
        ]);

        $name = time() . '_' . uniqid() . '.' . pathinfo($this->document->getRealPath(), PATHINFO_EXTENSION);

        $this->student->addMedia($this->document)
            ->usingName($this->document_name)
            ->usingFileName($name)
            ->toMediaCollection('documents');

        $this->document = null;
        $this->document_name = '';

        $this->loadDocuments();

        $this->dispatch('close-all-modals');
    }

    public string $deletingDocumentUuid = '';

    public function deleteDocument($uuid = ''): void
    {
        if ($this->deletingDocumentUuid == $uuid) {

            $document = Media::where('uuid', $uuid)->first();

            if ($document) {

                $document->delete();
                $this->loadDocuments();
                $this->deletingDocumentUuid = '';
                $this->dispatch('close-all-modals');
            }

        } else {

            $this->deletingDocumentUuid = $uuid;
        }
    }


}
