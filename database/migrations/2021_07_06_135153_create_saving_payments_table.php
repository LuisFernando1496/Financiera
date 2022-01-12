<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSavingPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('saving_payments', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->double('monto');
            $table->double('cambio');
            $table->double('efectivo')->nullable();
            $table->double('resta');
            $table->boolean('status');
            $table->integer('folio');
            $table->string('concepto');
            $table->unsignedBigInteger('saving_id');
            $table->foreign('saving_id')->references('id')->on('savings')->onDelete('cascade');
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
        Schema::dropIfExists('saving_payments');
    }
}
