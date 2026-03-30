<?php

namespace Modules\Assignments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryReceipt extends Model
{
    protected $fillable = [
        'codigo', 'tipo', 'assignment_id', 'movement_id',
        'entregado_por_employee_id', 'recibido_por_employee_id', 'fecha',
        'lugar', 'firma_entrega', 'firma_recepcion', 'observaciones',
        'estado', 'document_id', 'created_by',
    ];

    protected $casts = ['fecha' => 'date'];

    public function items(): HasMany { return $this->hasMany(DeliveryReceiptItem::class); }
    public function assignment(): BelongsTo { return $this->belongsTo(AssetAssignment::class); }
    public function movement(): BelongsTo { return $this->belongsTo(AssetMovement::class); }
    public function entregadoPor(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'entregado_por_employee_id'); }
    public function recibidoPor(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'recibido_por_employee_id'); }
    public function createdBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'created_by'); }
}
