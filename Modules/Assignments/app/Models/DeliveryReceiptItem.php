<?php

namespace Modules\Assignments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DeliveryReceiptItem extends Model
{
    protected $fillable = [
        'delivery_receipt_id', 'asset_id', 'condicion',
        'observaciones', 'accesorios_incluidos',
    ];

    protected $casts = ['accesorios_incluidos' => 'array'];

    public function deliveryReceipt(): BelongsTo { return $this->belongsTo(DeliveryReceipt::class); }
    public function asset(): BelongsTo { return $this->belongsTo(\Modules\Assets\Models\Asset::class); }
}
