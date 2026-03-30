<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CoreNotification extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'channel', 'type', 'notifiable_type', 'notifiable_id',
        'sourceable_type', 'sourceable_id', 'subject', 'data',
        'sent_at', 'read_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'read_at' => 'datetime',
    ];

    public function notifiable(): MorphTo
    {
        return $this->morphTo();
    }

    public function sourceable(): MorphTo
    {
        return $this->morphTo();
    }
}
