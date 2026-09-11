<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->restrictOnDelete();
            $table->string('folio')->nullable()->unique();
            $table->date('quote_date');
            $table->date('valid_until')->nullable();
            $table->string('status')->default('borrador');
            $table->string('delivery_time')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->timestamps();
            $table->index(['status', 'quote_date']);
        });
    }
    public function down(): void { Schema::dropIfExists('quotes'); }
};