<?php

namespace App\Livewire\Forms;

use App\Models\Expense;
use Livewire\Form;

class ExpenseForm extends Form
{

    public $model;

    public string $name = '';
    public string $amount = '';
    public string $date = '';
    public string $group_id = '';
    public string $note = '';

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'amount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'date' => ['required', 'date',],
            'group_id' => ['required', 'string', 'exists:groups,id'],
            'note' => ['nullable', 'string', 'min:1', 'max:10000'],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'name' => 'name',
            'amount' => 'amount',
            'date' => 'date',
            'group_id' => 'group',
            'note' => 'note'
        ];
    }

    public function setup($id): void
    {
        $model = Expense::findOrFail($id);

        $this->name = $model->name;
        $this->amount = $model->amount;
        $this->date = $model->date->format('Y-m-d');
        $this->group_id = $model->group_id;
        $this->note = $model->note;

        $this->model = $model;
    }

    public function store()
    {
        $this->validate();

        $data = $this->only(['name', 'amount', 'date', 'group_id', 'note']);

        $model = new Expense;

        return $model->create($data);
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only('name', 'amount', 'date', 'group_id', 'note'));
    }

}


