<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('name_arabic');
            $table->text('VsitType');
            $table->boolean('status')->default(false);
            $table->text('protected_area');
            $table->text('adult_ticket_price_usd');
            $table->text('adult_ticket_price_egp');
            $table->text('child_ticket_price_usd');
            $table->text('safari_ticket_price_usd');
            $table->text('safari_ticket_price_egp');
            $table->decimal('daily_ticket_price_usd');
            $table->decimal('daily_ticket_price_egp');
            $table->text('child_ticket_price_egp');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_prices');
    }
}
