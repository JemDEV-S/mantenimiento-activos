<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AiConversation extends Model
{
    protected $table = 'ai_conversations';

    protected $fillable = [
        'uuid', 'user_id', 'ai_provider_id', 'titulo', 'modulo',
        'contextable_type', 'contextable_id', 'estado', 'total_mensajes',
        'total_tokens', 'costo_total',
    ];

    protected $casts = ['costo_total' => 'decimal:6'];

    public function user(): BelongsTo { return $this->belongsTo(\App\Models\User::class); }
    public function provider(): BelongsTo { return $this->belongsTo(AiProvider::class, 'ai_provider_id'); }
    public function contextable(): MorphTo { return $this->morphTo(); }
    public function messages(): HasMany { return $this->hasMany(AiConversationMessage::class, 'ai_conversation_id'); }
    public function requests(): HasMany { return $this->hasMany(AiRequest::class, 'ai_conversation_id'); }
}
