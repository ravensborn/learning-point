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
        'type_name'
    ];

    const TYPE_WITHDRAW = 'withdraw';
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_PURCHASE = 'purchase';

    const TYPES = [
        self::TYPE_WITHDRAW => 'Withdraw',
        self::TYPE_DEPOSIT => 'Deposit',
        self::TYPE_PURCHASE => 'Purchase',
    ];

    public function sync(): void
    {

       if($this->transactable_type == Student::class) {

           $model = Student::find($this->transactable_id);
           $wallet = $model->getAttribute('wallet');
           $amount = $this->amount;

           if($this->type == self::TYPE_DEPOSIT) {
              $wallet += $amount;
           }
           if($this->type == self::TYPE_WITHDRAW) {
               $wallet -= $amount;
           }
           if($this->type == self::TYPE_PURCHASE) {
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
