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
        Schema::create('stock_ledgers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('store_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('reference_type', ['sale', 'purchase', 'adjustment', 'refund']);

            $table->unsignedBigInteger('reference_id')->nullable();

            $table->integer('qty_in')->default(0);
            $table->integer('qty_out')->default(0);

            $table->integer('stock_before');
            $table->integer('stock_after');

            $table->timestamps();

            $table->index(['product_id', 'reference_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_ledgers');
    }
};
