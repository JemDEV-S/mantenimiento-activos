<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentType extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'module', 'icon', 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function templates(): HasMany
    {
        return $this->hasMany(DocumentTemplate::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
