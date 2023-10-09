<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use Livewire\Form;

class GroupForm extends Form
{

    public $model;

    public string $name = '';
    public string $modelName = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'modelName' => ['required', 'string'],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'modelName' => 'model',
        ];
    }

    public function setup($id): void
    {
        $model = Group::findOrFail($id);

        $this->name = $model->name;
        $this->modelName = $model->model;

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['name', 'modelName']);

        $data['model'] = $data['modelName'];

        $model = new Group;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only(['name']));
    }
}


