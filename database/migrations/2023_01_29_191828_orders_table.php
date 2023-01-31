<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('phone', 100);
            $table->date('date', 100);          
            $table->string('street_name', 100);
            $table->string('street_number', 50);
            $table->string('district', 50);
            $table->string('city', 50);
            $table->string('state', 10);
            $table->string('zipcode', 50);
            $table->string('status', 50);
            $table->string('amount', 50);
            $table->longText('details')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
