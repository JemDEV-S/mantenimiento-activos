<?php

namespace Modules\Agent\Models;

use Illuminate\Database\Eloquent\Model;

class AgentConfig extends Model
{
    protected $table = 'agent_config';
    protected $fillable = ['clave', 'valor', 'tipo_dato', 'descripcion'];
}
