<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignNotification extends Model
{
    protected $fillable = [
        'maintenance_campaign_id', 'user_id', 'tipo', 'canal',
        'mensaje', 'read_at',
    ];

    protected $casts = ['read_at' => 'datetime'];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
    public function user(): BelongsTo { return $this->belongsTo(\App\Models\User::class); }
}
