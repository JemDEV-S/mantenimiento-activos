<?php

namespace Modules\AI\Models;

use Illuminate\Database\Eloquent\Model;

class AiPromptTemplate extends Model
{
    protected $table = 'ai_prompt_templates';

    protected $fillable = [
        'codigo', 'nombre', 'categoria', 'modulo', 'system_prompt',
        'user_prompt', 'variables_requeridas', 'formato_salida',
        'version', 'ejemplo_resultado', 'is_active',
    ];

    protected $casts = ['variables_requeridas' => 'array', 'is_active' => 'boolean'];
}
