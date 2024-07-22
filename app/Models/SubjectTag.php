<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectTag extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}
