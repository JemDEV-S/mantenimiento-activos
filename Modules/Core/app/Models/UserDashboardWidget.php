<?php

namespace Modules\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserDashboardWidget extends Model
{
    protected $fillable = [
        'user_dashboard_id', 'dashboard_widget_id', 'position_x',
        'position_y', 'width', 'height', 'config', 'sort_order',
    ];

    protected $casts = [
        'config' => 'array',
    ];

    public function dashboard(): BelongsTo
    {
        return $this->belongsTo(UserDashboard::class, 'user_dashboard_id');
    }

    public function widget(): BelongsTo
    {
        return $this->belongsTo(DashboardWidget::class, 'dashboard_widget_id');
    }
}
