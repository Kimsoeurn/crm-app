<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')
                ->nullable()
                ->references('id')
                ->on('customers')
                ->nullOnDelete();
            $table->string('invoice_number')->unique();
            $table->date('bill_date')->nullable();
            $table->date('due_date')->nullable();
            $table->date('expired_date')->nullable();
            $table->float('total', 11, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
