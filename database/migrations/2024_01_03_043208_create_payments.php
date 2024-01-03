<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->string('partnerCode', 255);
            $table->string('accessKey', 255);
            $table->string('requestId', 255);
            $table->decimal('amount', 10, 2);
            $table->string('orderId', 100);
            $table->string('orderInfo');
            $table->string('orderType', 50);
            $table->string('transId', 100)->primary();
            $table->string('localMessage');
            $table->dateTime('responseTime');
            $table->string('payType', 50);
            $table->string('signature', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
