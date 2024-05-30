<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_minuman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('menu_minuman_id')->constrained('menu_minuman')->cascadeOnDelete();
            $table->integer('quantity')->default(1);
            $table->integer('unit_items')->nullable();
            $table->integer('total_harga_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_minuman');
    }
};
