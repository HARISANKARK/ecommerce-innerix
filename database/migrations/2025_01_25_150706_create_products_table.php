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
        Schema::create('products', function (Blueprint $table) {
            $table->id('p_id');
            $table->text('p_name',255)->length;
            $table->bigInteger('p_category_id');
            $table->bigInteger('p_qty');
            $table->double('p_previous_price');
            $table->double('p_price');
            $table->double('p_discount_per');
            $table->text('p_image_path',255);
            $table->text('p_description',1000);
            $table->bigInteger('p_user_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
