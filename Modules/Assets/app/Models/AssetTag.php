<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AssetTag extends Model
{
    protected $fillable = ['nombre', 'slug', 'color'];

    public function assets(): BelongsToMany
    {
        return $this->belongsToMany(Asset::class, 'asset_tag_pivot')
            ->withTimestamps();
    }
}
