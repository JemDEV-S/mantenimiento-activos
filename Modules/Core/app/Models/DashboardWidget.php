<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardWidget extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'type', 'data_source_class',
        'default_config', 'module', 'is_active',
    ];

    protected $casts = [
        'default_config' => 'array',
        'is_active' => 'boolean',
    ];
}
