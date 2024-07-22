<?php

namespace App\Livewire\Forms;

use App\Models\SessionTag;
use Livewire\Form;

class SessionTagForm extends Form
{
    public $model;

    public string $name = '';
    public int $session_id = 0;

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'session_id' => ['required', 'integer', 'exists:sessions,id'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'session_id' => 'session',
        ];
    }

    public function setup($id): void
    {
        $model = SessionTag::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['session_id', 'name']);

        $model = new SessionTag;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('session_id', 'name'));
    }

}


