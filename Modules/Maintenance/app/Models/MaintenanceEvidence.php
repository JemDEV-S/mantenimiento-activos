<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceEvidence extends Model
{
    protected $fillable = [
        'maintenance_order_id', 'maintenance_record_id', 'tipo', 'etapa',
        'nombre_original', 'file_path', 'file_size', 'mime_type', 'uploaded_by',
    ];

    public function order(): BelongsTo { return $this->belongsTo(MaintenanceOrder::class, 'maintenance_order_id'); }
    public function record(): BelongsTo { return $this->belongsTo(MaintenanceRecord::class, 'maintenance_record_id'); }
    public function uploadedBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'uploaded_by'); }
}
