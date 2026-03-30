<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignTechnician extends Model
{
    protected $fillable = [
        'maintenance_campaign_id', 'tecnico_id', 'rol', 'zona_asignada',
        'sede_id', 'numero_lote', 'fecha_inicio', 'fecha_fin',
        'total_asignados', 'total_completados',
    ];

    protected $casts = ['fecha_inicio' => 'date', 'fecha_fin' => 'date'];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
    public function tecnico(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Tecnico::class); }
    public function sede(): BelongsTo { return $this->belongsTo(\Modules\Organization\Models\Sede::class); }
}
