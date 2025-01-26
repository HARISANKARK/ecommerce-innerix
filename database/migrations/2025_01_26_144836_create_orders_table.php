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
            $table->id('o_id');
            $table->date('date');
            $table->bigInteger('category_id');
            $table->bigInteger('product_id');
            $table->text('name',255)->length;
            $table->text('address',500);
            $table->bigInteger('contact_no');
            $table->text('lan_mark',255);
            $table->bigInteger('qty');
            $table->double('price');
            $table->double('amount');
            $table->bigInteger('o_user_id');
            $table->softDeletes();
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
