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
        Schema::create('sub_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_menu')->constrained('menus')->onDelete('cascade');
            $table->string('menu_id');
            $table->string('menu_en');
            $table->string('slug_id');
            $table->string('slug_en');
            $table->string('status');
            $table->string('url_id');
            $table->string('url_en');
            $table->integer('jenis_menu');
            $table->string('logo')->nullable();
            $table->string('page');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_menus');
    }
};
