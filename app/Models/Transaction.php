<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Self_;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'user' => 'object'
    ];
    protected $appends = [
        'type_name',
        'type_color_class'
    ];

    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_PURCHASE = 'purchase';
    const TYPE_TRANSFER_IN = 'transfer-in';
    const TYPE_TRANSFER_OUT = 'transfer-out';

    const TYPES = [
        self::TYPE_WITHDRAW => 'Withdraw',
        self::TYPE_DEPOSIT => 'Deposit',
        self::TYPE_PURCHASE => 'Purchase',
        self::TYPE_TRANSFER_IN => 'Transfer In',
        self::TYPE_TRANSFER_OUT => 'Transfer Out',
    ];

    const TYPE_COLOR_CLASSES = [
        self::TYPE_WITHDRAW => 'text-danger',
        self::TYPE_DEPOSIT => 'text-success',
        self::TYPE_PURCHASE => 'text-danger',
        self::TYPE_TRANSFER_IN => 'text-success',
        self::TYPE_TRANSFER_OUT => 'text-danger',
    ];
    const TYPE_PREFIX_CHARACTER = [
        self::TYPE_WITHDRAW => '▼',
        self::TYPE_DEPOSIT => '▲',
        self::TYPE_PURCHASE => '▼',
        self::TYPE_TRANSFER_IN => '▲',
        self::TYPE_TRANSFER_OUT => '▼',
    ];


    public function getTypeColorClassAttribute(): string
    {
        return self::TYPE_COLOR_CLASSES[$this->type];
    }

    public function getTypePrefixCharacterAttribute(): string
    {
        return self::TYPE_PREFIX_CHARACTER[$this->type];
    }

    public function sync($reversed = false): void
    {

       if(($this->amount > 0) && in_array($this->transactable_type, [Student::class, Teacher::class, Employee::class])) {

           $model = $this->transactable_type::find($this->transactable_id);
           $wallet = $model->getAttribute('wallet');
           $amount = $this->amount;

           if($reversed) {
               $amount = $amount * -1;
           }

           if($this->type == self::TYPE_DEPOSIT) {
              $wallet += $amount;
           }
           if($this->type == self::TYPE_WITHDRAW) {
               $wallet -= $amount;
           }
           if($this->type == self::TYPE_PURCHASE) {
               $wallet -= $amount;
           }
           if($this->type == self::TYPE_TRANSFER_IN) {
               $wallet += $amount;
           }

           if($this->type == self::TYPE_TRANSFER_OUT) {
               $wallet -= $amount;
           }

           $model->update([
               'wallet' => $wallet,
           ]);

       }
    }

    public function transactable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function getTypeNameAttribute(): string
    {
        return self::TYPES[$this->type];
    }


    public static function generateNumber(): string
    {
        $last =  self::orderBy('id', 'DESC')->first();
        $lastId = $last ? $last->id : 0;

        $prefix = 'TRS-';
        $next = 1 + $lastId;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
