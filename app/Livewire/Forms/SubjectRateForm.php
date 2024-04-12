<?php

namespace App\Livewire\Forms;

use App\Models\SubjectRate;
use Livewire\Form;

class SubjectRateForm extends Form
{

    public $model;

    public string $rate = '';
    public int $number_of_students = 1;
    public int $subject_id = 0;

    public function rules(): array
    {
        return [
            'rate' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'number_of_students' => ['required', 'integer', 'gt:0', 'unique:subject_rates,number_of_students' . (!empty($this->model) ? ',' . $this->model->id : '')],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'rate',
            'number_of_students' => 'number of students',
            'subject_id' => 'group',
        ];
    }

    public function setup($id): void
    {
        $model = SubjectRate::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['subject_id', 'rate', 'number_of_students']);

        $model = new SubjectRate;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('subject_id', 'rate', 'number_of_students'));
    }

}


