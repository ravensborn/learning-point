<?php

namespace App\Livewire\Forms;

use App\Models\SubjectTag;
use Livewire\Form;

class SubjectTagForm extends Form
{

    public $model;

    public string $name = '';
    public int $subject_id = 0;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'subject_id' => 'group',
        ];
    }

    public function setup($id): void
    {
        $model = SubjectTag::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['subject_id', 'name']);

        $model = new SubjectTag;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('subject_id', 'name'));
    }

}


