<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_receipt_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_receipt_id')->constrained('delivery_receipts')->cascadeOnDelete();
            $table->unsignedBigInteger('asset_id');
            $table->enum('condicion', ['nuevo', 'bueno', 'regular', 'malo', 'inservible']);
            $table->text('observaciones')->nullable();
            $table->json('accesorios_incluidos')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_receipt_items');
    }
};
