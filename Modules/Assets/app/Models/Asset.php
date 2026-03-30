<?php

namespace Modules\Assets\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'uuid', 'codigo_interno', 'codigo_patrimonial', 'numero_serie',
        'asset_type_id', 'marca_id', 'modelo_id', 'asset_status_id',
        'ubicacion_id', 'oficina_id', 'area_id', 'responsable_id',
        'proveedor_id', 'fecha_compra', 'fecha_garantia_fin', 'valor_compra',
        'valor_actual', 'moneda', 'criticidad', 'condicion',
        'frecuencia_mantenimiento_dias', 'notas', 'agent_device_id',
        'parent_asset_id', 'created_by',
    ];

    protected $casts = [
        'fecha_compra' => 'date',
        'fecha_garantia_fin' => 'date',
        'valor_compra' => 'decimal:2',
        'valor_actual' => 'decimal:2',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function modelo(): BelongsTo
    {
        return $this->belongsTo(Modelo::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(AssetStatus::class, 'asset_status_id');
    }

    public function ubicacion(): BelongsTo
    {
        return $this->belongsTo(\Modules\Organization\Models\Ubicacion::class);
    }

    public function oficina(): BelongsTo
    {
        return $this->belongsTo(\Modules\Organization\Models\Oficina::class);
    }

    public function area(): BelongsTo
    {
        return $this->belongsTo(\Modules\Organization\Models\Area::class);
    }

    public function responsable(): BelongsTo
    {
        return $this->belongsTo(\Modules\Staff\Models\Employee::class, 'responsable_id');
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(\Modules\Staff\Models\Proveedor::class);
    }

    public function parentAsset(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_asset_id');
    }

    public function childAssets(): HasMany
    {
        return $this->hasMany(self::class, 'parent_asset_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'created_by');
    }

    public function attributes(): HasMany
    {
        return $this->hasMany(AssetAttribute::class);
    }

    public function components(): HasMany
    {
        return $this->hasMany(AssetComponent::class);
    }

    public function licenses(): HasMany
    {
        return $this->hasMany(AssetLicense::class);
    }

    public function files(): HasMany
    {
        return $this->hasMany(AssetFile::class);
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(AssetStatusHistory::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(AssetTag::class, 'asset_tag_pivot')
            ->withTimestamps();
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(\Modules\Core\Models\Document::class, 'documentable');
    }
}
