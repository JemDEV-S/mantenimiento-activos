<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model
{
    protected $fillable = [
        'clave', 'valor', 'tipo_dato', 'modulo', 'grupo', 'descripcion',
        'valor_por_defecto', 'is_editable', 'is_sensitive', 'sort_order',
    ];

    protected $casts = ['is_editable' => 'boolean', 'is_sensitive' => 'boolean'];

    public function histories(): HasMany
    {
        return $this->hasMany(SettingHistory::class);
    }
}
