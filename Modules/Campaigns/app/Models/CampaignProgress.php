<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignProgress extends Model
{
    protected $table = 'campaign_progress';

    protected $fillable = [
        'maintenance_campaign_id', 'fecha', 'atendidos_acumulado',
        'pendientes', 'observados', 'fuera_servicio', 'costo_acumulado',
        'cobertura', 'notas',
    ];

    protected $casts = ['fecha' => 'date', 'costo_acumulado' => 'decimal:2', 'cobertura' => 'decimal:2'];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
}
