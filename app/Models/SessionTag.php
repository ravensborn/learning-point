<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionTag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Session::class);
    }
}
