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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('description')->nullable();
            $table->string('cover')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('category');
            $table->integer('price');
            $table->string('location')->nullable();
            $table->decimal('lat',10, 8)->nullable();
            $table->decimal('lng',10, 8)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
