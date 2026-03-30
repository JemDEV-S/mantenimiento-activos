<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiUsageStat extends Model
{
    protected $table = 'ai_usage_stats';

    protected $fillable = [
        'ai_provider_id', 'fecha', 'modulo', 'categoria', 'total_solicitudes',
        'total_tokens_entrada', 'total_tokens_salida', 'costo_total',
        'tiempo_promedio_ms', 'calificacion_promedio', 'total_aceptadas',
        'total_rechazadas',
    ];

    protected $casts = ['fecha' => 'date', 'costo_total' => 'decimal:6'];

    public function provider(): BelongsTo { return $this->belongsTo(AiProvider::class, 'ai_provider_id'); }
}
