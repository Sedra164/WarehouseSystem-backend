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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->enum('type',['purchase','sale','waste']);
            $table->date('date');
            $table->text('notes');
            $table->unsignedBigInteger('warehouse_product_id');
            $table->foreign('warehouse_product_id')->references('id')->on('warehouse_products')->onDelete('cascade');
            $table->unsignedBigInteger('partner_id')->nullable();
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('set null');
            $table->unsignedBigInteger('warehouse_user_id');
            $table->foreign('warehouse_user_id')->references('id')->on('warehouse_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
