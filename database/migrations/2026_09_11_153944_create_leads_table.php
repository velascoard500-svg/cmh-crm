<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->string('product');
            $table->string('stage')->default('nuevo');
            $table->decimal('estimated_amount', 12, 2)->default(0);
            $table->string('source')->nullable();
            $table->date('next_follow_up')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index('stage');
            $table->index('next_follow_up');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
