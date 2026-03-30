<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('document_type_id')->constrained('document_types');
            $table->foreignId('document_template_id')->nullable()->constrained('document_templates');
            $table->string('code')->unique();
            $table->string('documentable_type');
            $table->unsignedBigInteger('documentable_id');
            $table->string('title');
            $table->string('file_path');
            $table->bigInteger('file_size')->nullable();
            $table->string('mime_type')->default('application/pdf');
            $table->text('qr_code')->nullable();
            $table->enum('status', ['draft', 'generated', 'signed', 'annulled'])->default('generated');
            $table->text('annulment_reason')->nullable();
            $table->foreignId('annulled_by')->nullable()->constrained('users');
            $table->timestamp('annulled_at')->nullable();
            $table->json('metadata')->nullable();
            $table->foreignId('generated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            $table->index(['documentable_type', 'documentable_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
