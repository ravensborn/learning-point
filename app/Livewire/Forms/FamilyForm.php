<?php

namespace App\Livewire\Forms;

use App\Models\Family;
use Livewire\Form;

class FamilyForm extends Form
{

    public $model;

    public string $name = '';

    private array $attributes = ['name'];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50', 'unique:families,name' . (!empty($this->model) ? ',' . $this->model->id : '')],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
        ];
    }

    public function setup($id, $fill = true): void
    {
        $model = Family::findOrFail($id);

        if($fill) {
            $this->fill($model);
        }

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only($this->attributes);

        $data['number'] = Family::generateNumber();

        $model = new Family();

        return $this->model = $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only($this->attributes));
    }

}


