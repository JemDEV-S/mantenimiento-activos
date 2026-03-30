<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Marca extends Model
{
    protected $fillable = ['nombre', 'slug', 'logo_path', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];

    public function modelos(): HasMany
    {
        return $this->hasMany(Modelo::class);
    }
}
