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
        Schema::create('meja', function (Blueprint $table) {
            $table->id();
            $table->string('no_meja');
            $table->string('status');
            $table->string('kapasitas');
            $table->timestamps();
        });


        Schema::create('menu_makanan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_makanan');
            $table->text('image');
            $table->string('harga');
            $table->timestamps();
        });
        Schema::create('menu_minuman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_minuman');
            $table->text('image');
            $table->string('harga');
            $table->timestamps();
        });
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('meja_id');
            $table->timestamp('tgl_order');
            $table->string('total_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meja');
        Schema::dropIfExists('slot_meja');
        Schema::dropIfExists('menu_makanan');
        Schema::dropIfExists('menu_minuman');
        Schema::dropIfExists('order');
    }
};
