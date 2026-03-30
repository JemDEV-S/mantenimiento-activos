<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'document_type_id', 'document_template_id', 'code',
        'documentable_type', 'documentable_id', 'title', 'file_path',
        'file_size', 'mime_type', 'qr_code', 'status', 'annulment_reason',
        'annulled_by', 'annulled_at', 'metadata', 'generated_by',
    ];

    protected $casts = [
        'metadata' => 'array',
        'annulled_at' => 'datetime',
    ];

    public function documentType(): BelongsTo
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function template(): BelongsTo
    {
        return $this->belongsTo(DocumentTemplate::class, 'document_template_id');
    }

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'generated_by');
    }

    public function annulledBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'annulled_by');
    }

    public function downloads(): HasMany
    {
        return $this->hasMany(DocumentDownload::class);
    }
}
