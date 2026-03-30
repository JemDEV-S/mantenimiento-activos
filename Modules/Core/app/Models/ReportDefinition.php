<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ReportDefinition extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'module', 'category', 'query_class',
        'filters', 'columns', 'default_sort', 'chart_type', 'is_active',
    ];

    protected $casts = [
        'filters' => 'array',
        'columns' => 'array',
        'is_active' => 'boolean',
    ];

    public function savedViews(): HasMany
    {
        return $this->hasMany(SavedReportView::class);
    }

    public function scheduledReports(): HasMany
    {
        return $this->hasMany(ScheduledReport::class);
    }

    public function executions(): HasMany
    {
        return $this->hasMany(ReportExecution::class);
    }
}
