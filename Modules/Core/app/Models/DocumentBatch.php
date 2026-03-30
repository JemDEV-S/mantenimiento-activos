<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DocumentBatch extends Model
{
    protected $fillable = [
        'uuid', 'document_type_id', 'name', 'description', 'filters',
        'total_items', 'processed_items', 'failed_items', 'status',
        'consolidated_file_path', 'zip_file_path', 'started_at',
        'completed_at', 'error_message', 'created_by',
    ];

    protected $casts = [
        'filters' => 'array',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(DocumentBatchItem::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }
}
