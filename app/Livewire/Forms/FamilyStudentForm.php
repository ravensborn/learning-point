<?php

namespace App\Livewire\Forms;

use App\Models\Grade;
use App\Models\Student;
use Livewire\Form;

class FamilyStudentForm extends Form
{
    public $model;

    public int $family_id = 0;
    public int $student_id = 0;

    public function rules(): array
    {
        return [
            'family_id' => ['required', 'integer', 'exists:families,id'],
            'student_id' => ['required', 'integer', 'exists:students,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'family_id' => 'family',
            'student_id' => 'student',
        ];
    }

    public function setup($studentId, $familyId): void
    {
        $this->student_id = $studentId;
        $this->family_id = $familyId;
    }


    public function store(): true
    {
        $this->validate();

        $student = Student::findOrFail($this->student_id);

        return $student->update([
            'family_id' => $this->family_id
        ]);
    }
}


