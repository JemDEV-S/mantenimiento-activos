<?php

namespace Modules\Maintenance\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceSchedule extends Model
{
    protected $table = 'maintenance_schedule';

    protected $fillable = [
        'asset_id', 'maintenance_type_id', 'frecuencia_dias',
        'ultima_ejecucion', 'proxima_fecha', 'tecnico_id', 'is_active',
    ];

    protected $casts = [
        'ultima_ejecucion' => 'date',
        'proxima_fecha' => 'date',
        'is_active' => 'boolean',
    ];

    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
    public function type(): BelongsTo { return $this->belongsTo(MaintenanceType::class, 'maintenance_type_id'); }
    public function tecnico(): BelongsTo { return $this->belongsTo(\Modules\Staff\Models\Tecnico::class); }
}
