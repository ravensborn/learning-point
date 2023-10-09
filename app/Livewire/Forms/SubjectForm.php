<?php

namespace App\Livewire\Forms;

use App\Models\Subject;
use Livewire\Form;

class SubjectForm extends Form
{

    public $model;

    public string $name = '';
    public string $group_id = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'group_id' => ['required', 'string', 'exists:groups,id'],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'group_id' => 'group',
        ];
    }

    public function setup($id): void
    {
        $model = Subject::findOrFail($id);

        $this->name = $model->name;
        $this->group_id = $model->group_id;

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['name', 'group_id']);

        $model = new Subject;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('name', 'group_id'));
    }

}


