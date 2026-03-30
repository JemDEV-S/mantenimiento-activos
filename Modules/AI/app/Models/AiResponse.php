<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiResponse extends Model
{
    protected $table = 'ai_responses';

    protected $fillable = [
        'ai_request_id', 'respuesta_original', 'respuesta_parseada',
        'formato_salida', 'accion_usuario', 'contenido_editado',
        'motivo_rechazo', 'calificacion', 'es_util',
        'aplicada_en_type', 'aplicada_en_id',
    ];

    protected $casts = ['es_util' => 'boolean'];

    public function request(): BelongsTo { return $this->belongsTo(AiRequest::class, 'ai_request_id'); }
}
