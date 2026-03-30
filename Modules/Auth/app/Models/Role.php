<?php

namespace Modules\Auth\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'is_system'];

    protected $casts = ['is_system' => 'boolean'];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(\App\Models\User::class, 'role_user')
            ->withPivot('assigned_by')
            ->withTimestamps();
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
