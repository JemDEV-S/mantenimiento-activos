<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AiConversationMessage extends Model
{
    protected $table = 'ai_conversation_messages';

    protected $fillable = ['ai_conversation_id', 'rol', 'contenido', 'tokens', 'secuencia'];

    public function conversation(): BelongsTo { return $this->belongsTo(AiConversation::class, 'ai_conversation_id'); }
}
