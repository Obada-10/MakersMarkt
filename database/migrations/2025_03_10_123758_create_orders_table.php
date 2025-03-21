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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('basket_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['In productie', 'Verzonden', 'Geweigerd']);
        $table->text('status_description')->nullable();
        $table->string('name')->nullable();
        $table->string('address')->nullable();
        $table->string('street_name')->nullable();
        $table->string('postal_code')->nullable();
        $table->string('city')->nullable();
        $table->string('phone_number')->nullable();
        $table->string('email')->nullable();
        $table->decimal('total_price', 8, 2)->default(0);
        $table->timestamps();
    });

    // Maak de pivot-tabel voor de many-to-many relatie tussen orders en products
    Schema::create('order_product', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->onDelete('cascade');
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
