<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'time_in' => 'datetime',
        'time_out' => 'datetime',
    ];

    protected $appends = [
        'status_name',
        'status_color_class',
        'type_name',
    ];

    const STATUSES = [
        self::STATUS_PENDING => 'Pending',
        self::STATUS_PROCESSED => 'Processed',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PROCESSED = 'processed';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELLED = 'cancelled';

    const STATUS_COLOR_CLASSES = [
        self::STATUS_PENDING => 'bg-yellow',
        self::STATUS_PROCESSED => 'bg-primary',
        self::STATUS_COMPLETED => 'bg-success',
        self::STATUS_CANCELLED => 'bg-danger',
    ];

    public function getStatusNameAttribute(): string
    {
        return self::STATUSES[$this->status];
    }

    public function getStatusColorClassAttribute(): string
    {
        return self::STATUS_COLOR_CLASSES[$this->status];
    }

    const TYPES = [
        self::TYPE_THEORETICAL => 'Theoretical',
        self::TYPE_PRACTICAL => 'Practical',
    ];
    const TYPE_THEORETICAL = 'theoretical';
    const TYPE_PRACTICAL = 'practical';

    public function getTypeNameAttribute(): string
    {
        return self::TYPES[$this->type];
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
    public function attendees(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Attendee::class);
    }


    public static function generateNumber(): string
    {
        $last =  self::orderBy('id', 'DESC')->first();
        $lastId = $last ? $last->id : 0;

        $prefix = 'SESH-';
        $next = 1 + $lastId;

        return sprintf(
            '%s%s',
            $prefix,
            str_pad((string)$next, 6, "0", STR_PAD_LEFT)
        );
    }
}
