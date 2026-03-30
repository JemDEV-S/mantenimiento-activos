<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignScopeFilter extends Model
{
    protected $fillable = ['maintenance_campaign_id', 'tipo', 'operador', 'valor'];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
}
