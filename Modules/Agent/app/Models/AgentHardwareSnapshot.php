<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentHardwareSnapshot extends Model
{
    protected $fillable = [
        'agent_device_id', 'hash', 'hostname', 'fabricante', 'modelo', 'serial',
        'bios', 'placa_base', 'procesador', 'ram_total_mb', 'ram_disponible_mb',
        'ram_slots', 'discos', 'monitores', 'gpu', 'usb_dispositivos',
        'perifericos', 'tiene_cambios', 'resumen_cambios',
    ];

    protected $casts = [
        'bios' => 'array', 'placa_base' => 'array', 'procesador' => 'array',
        'ram_slots' => 'array', 'discos' => 'array', 'monitores' => 'array',
        'gpu' => 'array', 'usb_dispositivos' => 'array', 'perifericos' => 'array',
        'tiene_cambios' => 'boolean',
    ];

    public function device(): BelongsTo { return $this->belongsTo(AgentDevice::class, 'agent_device_id'); }
}
