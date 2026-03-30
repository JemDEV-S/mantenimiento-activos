<?php

namespace Modules\Staff\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecnico extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id', 'especialidad', 'certificacion', 'nivel',
        'disponibilidad', 'notas', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
}
