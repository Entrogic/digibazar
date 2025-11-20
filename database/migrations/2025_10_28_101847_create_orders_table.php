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
            $table->string('order_number')->unique();

            
            
            // Customer Information
            $table->string('customer_name');
            $table->string('customer_email')->nullable();
            $table->string('customer_phone');
            $table->text('customer_address');
            
            // Order Status
            $table->enum('status', [
                'pending',
                'confirmed',
                'processing',
                'out_for_delivery',
                'delivered',
                'cancelled'
            ])->default('pending');

            // Payment Information
            $table->enum('payment_method', ['cash_on_delivery', 'mobile_banking']);
            $table->enum('payment_status', ['pending', 'paid', 'failed'])->default('pending');
            
            // Additional Information
            $table->string('delivery_charge')->default(0);
            $table->decimal('order_total', 10, 2); 
            $table->text('notes')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamps();

            // Indexes
            $table->index('order_number');
            $table->index('status');
            $table->index('customer_phone');
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
