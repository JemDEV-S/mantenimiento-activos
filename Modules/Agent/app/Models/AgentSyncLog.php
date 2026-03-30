<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentSyncLog extends Model
{
    protected $fillable = [
        'agent_device_id', 'tipo', 'estado', 'payload_size_bytes',
        'tiempo_respuesta_ms', 'ip_address', 'error_message',
    ];

    public function device(): BelongsTo { return $this->belongsTo(AgentDevice::class, 'agent_device_id'); }
}
