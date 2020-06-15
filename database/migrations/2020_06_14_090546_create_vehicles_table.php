<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vehicle_name');
            $table->text('name_arabic');
            $table->text('description_arabic');
            $table->string('logo');
            $table->text('description');
            $table->text('protected_area');
            $table->text('type');
            $table->decimal('daily_ticket_price_usd');
            $table->decimal('daily_ticket_price_ESD');
            $table->decimal('safari_ticket_price_USD');
            $table->decimal('safari_ticket_price_ESD');
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}