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
        Schema::create('order_assigns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->string('fwd_by')->nullable();
            $table->string('notes')->nullable();
            $table->string('fwd_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_assigns');
    }
};
