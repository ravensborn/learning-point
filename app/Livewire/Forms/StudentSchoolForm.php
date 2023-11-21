<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use App\Models\StudentSchool;
use Livewire\Form;

class StudentSchoolForm extends Form
{

    public $model;

    public int $student_id = 0;

    public string $name = '';
    public string $grade = '';
    public string $academic_stream = '';

    public string $school_url = '';
    public string $username = '';
    public string $password = '';

    private array $attributes = ['student_id', 'name', 'grade', 'academic_stream', 'school_url', 'username', 'password'];

    public function rules(): array
    {
        return [
            'student_id' => ['required', 'integer', 'exists:students,id'],
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'grade' => ['required', 'string', 'min:1', 'max:50'],
            'academic_stream' => ['required', 'string', 'in:' . implode(',', array_keys(Student::ACADEMIC_STREAMS))],
            'school_url' => ['required', 'url', 'min:1', 'max:50'],
            'username' => ['required', 'string', 'min:1', 'max:50'],
            'password' => ['required', 'string', 'min:1', 'max:50'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'grade' => 'grade',
            'academic_stream' => 'academic stream',
            'school_url' => 'school url',
            'username' => 'username',
            'password' => 'password',
        ];
    }

    public function setup($id, $fill = true): void
    {
        $model = StudentSchool::findOrFail($id);

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


