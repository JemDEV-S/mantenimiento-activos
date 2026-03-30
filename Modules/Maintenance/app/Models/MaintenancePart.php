<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenancePart extends Model
{
    protected $fillable = [
        'maintenance_record_id', 'tipo', 'nombre', 'marca', 'modelo',
        'serial_nuevo', 'serial_anterior', 'cantidad', 'costo_unitario',
        'costo_total', 'proveedor_id', 'estado_instalacion',
    ];

    protected $casts = ['costo_unitario' => 'decimal:2', 'costo_total' => 'decimal:2'];

    public function record(): BelongsTo { return $this->belongsTo(MaintenanceRecord::class, 'maintenance_record_id'); }
    public function proveedor(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Proveedor::class); }
}
