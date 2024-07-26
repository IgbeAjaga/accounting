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
        Schema::create('cartonqty', function (Blueprint $table) {
            $table->id();
            $table->decimal('oldqty', 15, 2)->default(0.00);
            $table->decimal('kg', 15, 2)->default(0.00);
            $table->decimal('qtybal', 15, 2)->default(0.00);
            $table->decimal('oldamount', 15, 2)->default(0.00);
            $table->decimal('currentamount', 15, 2)->default(0.00);
            $table->decimal('amountbal', 15, 2)->default(0.00);
            $table->string('transactiontype')->default('credit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartonqty');
    }
};
