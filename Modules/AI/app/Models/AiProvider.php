<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AiProvider extends Model
{
    protected $table = 'ai_providers';

    protected $fillable = [
        'nombre', 'tipo', 'base_url', 'api_key_encrypted', 'modelo_default',
        'modelos_disponibles', 'max_tokens', 'temperatura', 'limite_diario',
        'limite_mensual', 'costo_por_input_token', 'costo_por_output_token',
        'is_active', 'ultimo_health_check',
    ];

    protected $casts = [
        'modelos_disponibles' => 'array',
        'is_active' => 'boolean',
        'ultimo_health_check' => 'datetime',
    ];

    protected $hidden = ['api_key_encrypted'];

    public function conversations(): HasMany { return $this->hasMany(AiConversation::class, 'ai_provider_id'); }
    public function requests(): HasMany { return $this->hasMany(AiRequest::class, 'ai_provider_id'); }
    public function usageStats(): HasMany { return $this->hasMany(AiUsageStat::class, 'ai_provider_id'); }
}
