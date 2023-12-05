<?php

namespace App\Livewire\Forms;

use App\Models\School;
use Livewire\Form;

class SchoolForm extends Form
{

    public $model;

    public int $student_id = 0;

    public string $name = '';
    public string $url = '';

    private array $attributes = ['student_id', 'name', 'url'];

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'url' => ['required', 'url', 'min:1', 'max:50'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'url' => 'school url',
        ];
    }

    public function setup($id, $fill = true): void
    {
        $model = School::findOrFail($id);

        if($fill) {
            $this->fill($model);
        }

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only($this->attributes);

        $model = new StudentSchool();

        return $this->model = $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only($this->attributes));
    }

}


