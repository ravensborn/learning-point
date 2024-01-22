<?php

namespace App\Livewire\Forms;

use App\Models\Session;
use App\Models\Subject;
use Livewire\Form;

class SessionForm extends Form
{

    public $model;

    public string $user_id = '';
    public string $teacher_id = '';
    public string $subject_id = '';
    public string $type = '';
    public string $status = Session::STATUS_PENDING;
    public array $students = [];
    public string $time_in = '';
    public string $time_out = '';
    public string $note = '';

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'string', 'exists:users,id'],
            'teacher_id' => ['required', 'string', 'exists:teachers,id'],
            'subject_id' => ['required', 'string', 'exists:subjects,id'],
            'type' => ['required', 'string', 'in:' . implode(',', array_keys(Session::TYPES))],
            'status' => ['required', 'string', 'in:' . implode(',', array_keys(Session::STATUSES))],
            'students' => ['required', 'array', 'min:1'],
            'time_in' => ['required', 'date'],
            'time_out' => ['required', 'date', 'after:time_in'],
            'note' => ['nullable', 'string', 'min:1', 'max:10000'],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'user_id' => 'user',
            'teacher_id' => 'teacher',
            'subject_id' => 'subject',
            'type' => 'type',
            'status' => 'status',
            'students' => 'students',
            'time_in' => 'time in',
            'time_out' => 'time out',
            'note' => 'note',
        ];
    }

    public function setup($id): void
    {
        $model = Session::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['user_id', 'teacher_id', 'subject_id', 'type', 'status', 'students', 'time_in', 'time_out', 'note']);

        $model = new Session;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only(['user_id', 'teacher_id', 'subject_id', 'type', 'status', 'students', 'time_in', 'time_out', 'note']));
    }

}


