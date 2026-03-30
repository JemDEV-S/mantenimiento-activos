<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ScheduledReport extends Model
{
    protected $fillable = [
        'report_definition_id', 'user_id', 'name', 'frequency',
        'day_of_week', 'day_of_month', 'time', 'export_format',
        'filters', 'recipients', 'is_active', 'last_run_at', 'next_run_at',
    ];

    protected $casts = [
        'filters' => 'array',
        'recipients' => 'array',
        'is_active' => 'boolean',
        'last_run_at' => 'datetime',
        'next_run_at' => 'datetime',
    ];

    public function reportDefinition(): BelongsTo
    {
        return $this->belongsTo(ReportDefinition::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function executions(): HasMany
    {
        return $this->hasMany(ReportExecution::class);
    }
}
