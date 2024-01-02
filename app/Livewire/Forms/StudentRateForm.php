<?php

namespace App\Livewire\Forms;

use App\Models\StudentRate;
use Livewire\Form;

class StudentRateForm extends Form
{

    public $model;

    public string $rate = '';
    public int $number_of_students = 1;
    public int $student_id = 0;
    public int $subject_id = 0;

    public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'number_of_students' => ['required', 'integer', 'gt:0'],
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'rate' => 'rate',
            'number_of_students' => 'number of students',
            'student_id' => 'student',
            'subject_id' => 'subject',
        ];
    }

    public function setup($id): void
    {
        $model = StudentRate::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['student_id', 'subject_id', 'rate', 'number_of_students']);

        $model = new StudentRate;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('student_id', 'subject_id', 'rate', 'number_of_students'));
    }

}


