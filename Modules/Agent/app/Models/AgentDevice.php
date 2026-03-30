<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgentDevice extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'token', 'hostname', 'identificador', 'fabricante', 'modelo',
        'serial', 'sistema_operativo', 'version_agente', 'asset_id',
        'estado_vinculacion', 'is_online', 'ultima_ip', 'ultimo_heartbeat',
        'primera_sincronizacion', 'ultima_sincronizacion', 'is_active',
    ];

    protected $casts = [
        'is_online' => 'boolean',
        'is_active' => 'boolean',
        'ultimo_heartbeat' => 'datetime',
        'primera_sincronizacion' => 'datetime',
        'ultima_sincronizacion' => 'datetime',
    ];

    protected $hidden = ['token'];

    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function heartbeats(): HasMany { return $this->hasMany(AgentHeartbeat::class); }
    public function hardwareSnapshots(): HasMany { return $this->hasMany(AgentHardwareSnapshot::class); }
    public function softwareSnapshots(): HasMany { return $this->hasMany(AgentSoftwareSnapshot::class); }
    public function networkSnapshots(): HasMany { return $this->hasMany(AgentNetworkSnapshot::class); }
    public function alerts(): HasMany { return $this->hasMany(AgentAlert::class); }
    public function syncLogs(): HasMany { return $this->hasMany(AgentSyncLog::class); }
}
