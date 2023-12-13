<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function students(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function wallet(): float
    {
        return $this->students()->sum('wallet');
    }


    public static function generateNumber(): string
    {
        $last = self::orderBy('id', 'DESC')->first();
        $lastId = $last ? $last->id : 0;

        $prefix = 'FAM-';
        $next = 1 + $lastId;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 4, "0", STR_PAD_LEFT)
        );
    }
}
