<?php

namespace Modules\Audit\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataExport extends Model
{
    protected $fillable = [
        'user_id', 'formato', 'modulo', 'tipo_entidad', 'filtros_aplicados',
        'cantidad_registros', 'file_path', 'file_size', 'estado',
        'error_message', 'solicitado_at', 'completado_at', 'expira_at',
    ];

    protected $casts = [
        'filtros_aplicados' => 'array',
        'solicitado_at' => 'datetime',
        'completado_at' => 'datetime',
        'expira_at' => 'datetime',
    ];

    public function user(): BelongsTo { return $this->belongsTo(\App\Models\User::class); }
}
