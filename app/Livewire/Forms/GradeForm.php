<?php

namespace App\Livewire\Forms;

use App\Models\Grade;
use Livewire\Form;

class GradeForm extends Form
{
    public $model;

    public int $school_id = 0;
    public string $name = '';
    public string $cost = '';

    public function rules(): array
    {
        return [
            'school_id' => ['required', 'integer', 'exists:schools,id'],
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'cost' => ['required', 'integer', 'min:0'],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'school_id' => 'school',
            'name' => 'name',
            'cost' => 'cost',
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

        $data = $this->only(['school_id', 'name', 'cost']);

        $model = new Grade;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();
        return $this->model->update($this->only(['school_id', 'name', 'cost']));
    }
}


