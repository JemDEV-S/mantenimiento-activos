<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentTemplate extends Model
{
    protected $fillable = [
        'document_type_id', 'name', 'slug', 'description', 'view_path',
        'variables', 'orientation', 'paper_size', 'header_enabled',
        'footer_enabled', 'version', 'is_active',
    ];

    protected $casts = [
        'variables' => 'array',
        'header_enabled' => 'boolean',
        'footer_enabled' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
