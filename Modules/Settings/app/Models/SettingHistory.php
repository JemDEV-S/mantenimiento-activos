<?php

namespace Modules\Settings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettingHistory extends Model
{
    protected $fillable = ['setting_id', 'valor_anterior', 'valor_nuevo', 'changed_by'];

    public function setting(): BelongsTo { return $this->belongsTo(Setting::class); }
    public function changedBy(): BelongsTo { return $this->belongsTo(\App\Models\User::class, 'changed_by'); }
}
