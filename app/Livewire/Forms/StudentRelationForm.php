<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use App\Models\StudentRelation;
use Illuminate\Validation\ValidationException;
use Livewire\Form;

class StudentRelationForm extends Form
{

    public $model;

    public string $name = '';

    public int $student_id = 0;
    public int $related_id = 0;

    private array $attributes = [
        'student_id',
        'related_id',
        'name',
    ];

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'related_id' => ['required', 'integer', 'exists:students,id'],
            'name' => ['required', 'string', 'min:1', 'max:50'],];
    }

    public function validationAttributes(): array
    {
        return [
            'student_id' => 'student',
            'related_id' => 'student',
            'name' => 'name',
        ];
    }

    public function setup($id, $fill = true): void
    {
        $model = StudentRelation::findOrFail($id);

        if($fill) {
            $this->fill($model);
        }

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $checkForExisting = StudentRelation::where('student_id', $this->student_id)
            ->where('related_id', $this->related_id)
            ->first();

        $checkForExistingSecond = StudentRelation::where('related_id', $this->student_id)
            ->where('student_id', $this->related_id)
            ->first();

        if($checkForExisting || $checkForExistingSecond) {
            throw ValidationException::withMessages(['studentRelationForm.name' => 'Relation already exists between selected students.']);
        }

        if($this->student_id == $this->related_id) {
            throw ValidationException::withMessages(['studentRelationForm.name' => 'Cannot relate to self.']);
        }

        $data = $this->only($this->attributes);

        $model = new StudentRelation();

        $this->model = $model->create($data);

        $this->createRelatedStudentRecord();

        return $this->model;
    }

    public function createRelatedStudentRecord(): void
    {
       $model = new StudentRelation();
       $model->create([
           'student_id' => $this->related_id,
           'related_id' => $this->student_id,
           'name' => $this->model->name,
       ]);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only($this->attributes));
    }

}


