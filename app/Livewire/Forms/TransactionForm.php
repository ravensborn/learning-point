<?php

namespace App\Livewire\Forms;

use App\Models\Group;
use App\Models\Student;
use App\Models\Transaction;
use Livewire\Form;

class TransactionForm extends Form
{

    public $model;

    public int $transactable_id = 0;

    public string $type = '';
    public string $amount = '';
    public string $description = '';

    public function rules(): array
    {
        return [
            'type' => ['required', 'string', 'in:' . implode(',', array_keys(Transaction::TYPES))],
            'amount' => ['required', 'numeric', 'gt:0', 'regex:/^[0-9]+(\.[0-9]{1,2})?$/'],
            'description' => ['required', 'string', 'max:10000'],
            ];
    }

    public function validationAttributes(): array
    {
        return [
            'type' => 'action',
            'amount' => 'amount',
            'description' => 'description',
        ];
    }

    public function setup($id): void
    {
        $model = Transaction::findOrFail($id);

        $this->fill($model);

        $this->model = $model;
    }

    public function transfer($transactableModel, $fromId, $toId, $amount, $description): void
    {
        //Deduct from sender
        $this->transactable_id = $fromId;
        $this->type = Transaction::TYPE_TRANSFER;
        $this->amount = $amount;
        $this->description = $description;
        $this->store($transactableModel);
        $this->model->sync();

        //Add to receiver
        $this->transactable_id = $toId;
        $this->type = Transaction::TYPE_DEPOSIT;
        $this->amount = $amount;
        $this->description = 'Internal Transfer, reference: ' . $fromId . ' - ' . $this->model->number . '.';
        $this->store($transactableModel);
        $this->model->sync();
    }
    public function store($transactableModel)
    {
        $this->validate();

        $data = $this->only(['type', 'amount', 'description']);
        $data['number'] = Transaction::generateNumber();
        $data['user'] = auth()->user();
        $data['transactable_id'] = $this->transactable_id;
        $data['transactable_type'] = $transactableModel;

        $model = new Transaction;
        $this->model = $model->create($data);
        return $this->model;
    }

    public function update()
    {
        $this->validate();

        return $this->model->update($this->only(['type', 'amount', 'description']));
    }
}


