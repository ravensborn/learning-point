<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use Livewire\Form;

class StudentForm extends Form
{

    public $model;

    public string $name = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
        ];
    }

    public function setup($id): void
    {
        $model = Student::findOrFail($id);

        $this->name = $model->name;

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['name']);

        $model = new Student();

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('name'));
    }

}


