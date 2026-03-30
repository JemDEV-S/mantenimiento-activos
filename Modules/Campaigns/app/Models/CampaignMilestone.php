<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignMilestone extends Model
{
    protected $fillable = [
        'maintenance_campaign_id', 'nombre', 'descripcion',
        'fecha_objetivo', 'fecha_real', 'estado', 'responsable_id',
    ];

    protected $casts = ['fecha_objetivo' => 'date', 'fecha_real' => 'date'];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
    public function responsable(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'responsable_id'); }
}
