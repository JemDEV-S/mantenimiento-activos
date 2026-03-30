<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignAsset extends Model
{
    protected $fillable = [
        'maintenance_campaign_id', 'asset_id', 'tecnico_id', 'estado',
        'numero_lote', 'zona', 'fecha_programada', 'fecha_atendida',
        'maintenance_order_id', 'prioridad', 'reprogramado_a_campaign_id',
        'motivo_reprogramacion',
    ];

    protected $casts = ['fecha_programada' => 'date', 'fecha_atendida' => 'date'];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function tecnico(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Tecnico::class); }
    public function maintenanceOrder(): BelongsTo { return $this->belongsTo(\Modules\Maintenance\Models\MaintenanceOrder::class); }
}
