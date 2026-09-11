<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('persona');
            $table->string('name');
            $table->string('business_name')->nullable();
            $table->string('phone', 30);
            $table->string('email')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('address')->nullable();
            $table->string('source')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index('name');
            $table->index('phone');
            $table->index('active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
