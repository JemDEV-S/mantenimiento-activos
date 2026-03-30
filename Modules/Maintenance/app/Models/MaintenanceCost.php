<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceCost extends Model
{
    protected $fillable = [
        'maintenance_order_id', 'categoria', 'descripcion', 'monto_estimado',
        'monto_real', 'moneda', 'proveedor_id', 'numero_factura',
        'estado_aprobacion', 'aprobado_por',
    ];

    protected $casts = ['monto_estimado' => 'decimal:2', 'monto_real' => 'decimal:2'];

    public function order(): BelongsTo { return $this->belongsTo(MaintenanceOrder::class, 'maintenance_order_id'); }
    public function proveedor(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Proveedor::class); }
    public function aprobadoPor(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'aprobado_por'); }
}
