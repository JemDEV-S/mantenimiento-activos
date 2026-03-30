<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserDashboard extends Model
{
    protected $fillable = [
        'user_id', 'name', 'type', 'layout', 'is_default',
    ];

    protected $casts = [
        'layout' => 'array',
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function widgets(): HasMany
    {
        return $this->hasMany(UserDashboardWidget::class);
    }
}
