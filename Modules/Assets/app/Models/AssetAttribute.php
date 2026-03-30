<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AssetAttribute extends Model
{
    protected $fillable = ['asset_id', 'nombre', 'valor', 'tipo_dato', 'grupo', 'sort_order'];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }
}
