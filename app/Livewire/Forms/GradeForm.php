<?php

namespace App\Livewire\Forms;

use App\Models\Grade;
use Livewire\Form;

class GradeForm extends Form
{
    public $model;

    public int $school_id = 0;
    public string $name = '';

    public function rules(): array
    {
        return [
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'name' => ['required', 'string', 'min:1', 'max:50', 'unique:grades,name' . (!empty($this->model) ? ',' . $this->model->id : '')],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'school_id' => 'school',
            'name' => 'name',
        ];
    }

    public function setup($id): void
    {
        $model = Grade::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['school_id', 'name']);

        $model = new Grade;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();
        return $this->model->update($this->only(['school_id', 'name']));
    }
}


