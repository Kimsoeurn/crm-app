<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('invoice_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')
                ->nullable()
                ->references('id')
                ->on('invoices')
                ->cascadeOnDelete();
            $table->foreignId('service_id')
                ->nullable()
                ->references('id')
                ->on('services')
                ->nullOnDelete();
            $table->text('description')->nullable();
            $table->integer('qty')->nullable();
            $table->float('price', 11, 2)->nullable();
            $table->float('discount', 11, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoice_details');
    }
};
