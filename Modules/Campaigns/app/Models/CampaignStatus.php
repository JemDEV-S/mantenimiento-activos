<?php

namespace Modules\Campaigns\Models;

use Illuminate\Database\Eloquent\Model;

class CampaignStatus extends Model
{
    protected $fillable = ['nombre', 'slug', 'color', 'sort_order', 'is_active'];
    protected $casts = ['is_active' => 'boolean'];
}
