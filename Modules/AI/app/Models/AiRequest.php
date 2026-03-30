<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AiRequest extends Model
{
    protected $table = 'ai_requests';

    protected $fillable = [
        'uuid', 'ai_provider_id', 'ai_prompt_template_id', 'ai_conversation_id',
        'user_id', 'modelo_usado', 'categoria', 'modulo', 'contextable_type',
        'contextable_id', 'system_prompt_enviado', 'user_prompt_enviado',
        'datos_contexto', 'tokens_entrada', 'tokens_salida', 'costo_estimado',
        'tiempo_respuesta_ms', 'estado', 'error_message',
    ];

    protected $casts = ['datos_contexto' => 'array', 'costo_estimado' => 'decimal:6'];

    public function provider(): BelongsTo { return $this->belongsTo(AiProvider::class, 'ai_provider_id'); }
    public function promptTemplate(): BelongsTo { return $this->belongsTo(AiPromptTemplate::class, 'ai_prompt_template_id'); }
    public function conversation(): BelongsTo { return $this->belongsTo(AiConversation::class, 'ai_conversation_id'); }
    public function user(): BelongsTo { return $this->belongsTo(\App\Models\User::class); }
    public function contextable(): MorphTo { return $this->morphTo(); }
    public function response(): HasOne { return $this->hasOne(AiResponse::class, 'ai_request_id'); }
}
