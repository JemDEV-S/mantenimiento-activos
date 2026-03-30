<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceSignature extends Model
{
    protected $fillable = [
        'maintenance_order_id', 'maintenance_record_id', 'tipo_firmante',
        'employee_id', 'nombre_firmante', 'cargo_firmante', 'firma_digital',
        'es_conforme', 'observaciones', 'ip_address', 'signed_at',
    ];

    protected $casts = ['es_conforme' => 'boolean', 'signed_at' => 'datetime'];

    public function order(): BelongsTo { return $this->belongsTo(MaintenanceOrder::class, 'maintenance_order_id'); }
    public function record(): BelongsTo { return $this->belongsTo(MaintenanceRecord::class, 'maintenance_record_id'); }
    public function employee(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class); }
}
