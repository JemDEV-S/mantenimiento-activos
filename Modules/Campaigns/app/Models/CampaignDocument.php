<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CampaignDocument extends Model
{
    protected $fillable = [
        'maintenance_campaign_id', 'document_id', 'rol_documento',
        'titulo', 'file_path', 'created_by',
    ];

    public function campaign(): BelongsTo { return $this->belongsTo(MaintenanceCampaign::class, 'maintenance_campaign_id'); }
    public function document(): BelongsTo { return $this->belongsTo(\Modules\Core\Models\Document::class); }
    public function createdBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
}
