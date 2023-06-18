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
        Schema::create('content_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_menu')->constrained('menus')->onDelete('cascade');
            $table->longText('page_id');
            $table->longText('page_en');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_menus');
    }
};
