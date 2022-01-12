<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->boolean('tipo');
            $table->date('fecha');
            $table->date('fecha_limite');
            $table->double('monto');
            $table->double('cambio');
            $table->double('efectivo')->nullable();
            $table->double('resta');
            $table->boolean('status');
            $table->integer('folio');
            $table->string('concepto');
            $table->double('moratorios');
            $table->unsignedBigInteger('credit_id');
            $table->foreign('credit_id')->references('id')->on('credits')->onDelete('cascade');

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
        Schema::dropIfExists('payments');
    }
}
