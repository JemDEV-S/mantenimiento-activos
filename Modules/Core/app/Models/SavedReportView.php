<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavedReportView extends Model
{
    protected $fillable = [
        'report_definition_id', 'user_id', 'name', 'filters', 'columns',
        'sort_by', 'sort_direction', 'is_default',
    ];

    protected $casts = [
        'filters' => 'array',
        'columns' => 'array',
        'is_default' => 'boolean',
    ];

    public function reportDefinition(): BelongsTo
    {
        return $this->belongsTo(ReportDefinition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
