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
        Schema::create('donations', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('user_id');
            $table->string('title');
            $table->longText('description');
            $table->string('cover_image_url');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->float('goal',8,2);
            $table->float('current_amount',8,2)->default(0)->nullable();
            $table->string('slug');
            $table->string('status')->default(\App\Models\Donation::STATUS_ZERO);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donations');
    }
};
