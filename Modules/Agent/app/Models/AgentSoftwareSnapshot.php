<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgentSoftwareSnapshot extends Model
{
    protected $fillable = [
        'agent_device_id', 'hash', 'sistema_operativo', 'nombre_equipo_red',
        'software_instalado', 'software_conteo', 'antivirus', 'programas_inicio',
        'actualizaciones_pendientes', 'tiene_cambios', 'resumen_cambios',
    ];

    protected $casts = [
        'sistema_operativo' => 'array', 'software_instalado' => 'array',
        'antivirus' => 'array', 'programas_inicio' => 'array',
        'actualizaciones_pendientes' => 'array', 'tiene_cambios' => 'boolean',
    ];

    public function device(): BelongsTo { return $this->belongsTo(AgentDevice::class, 'agent_device_id'); }
}
