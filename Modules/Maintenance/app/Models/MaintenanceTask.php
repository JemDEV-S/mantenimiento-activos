<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceTask extends Model
{
    protected $fillable = [
        'maintenance_order_id', 'maintenance_record_id', 'tipo',
        'descripcion', 'estado', 'tiempo_estimado_minutos',
        'tiempo_real_minutos', 'observaciones',
    ];

    public function order(): BelongsTo { return $this->belongsTo(MaintenanceOrder::class, 'maintenance_order_id'); }
    public function record(): BelongsTo { return $this->belongsTo(MaintenanceRecord::class, 'maintenance_record_id'); }
}
