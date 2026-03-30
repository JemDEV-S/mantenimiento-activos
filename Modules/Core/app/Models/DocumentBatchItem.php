<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DocumentBatchItem extends Model
{
    protected $fillable = [
        'document_batch_id', 'documentable_type', 'documentable_id',
        'document_id', 'status', 'error_message',
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(DocumentBatch::class, 'document_batch_id');
    }

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }
}
