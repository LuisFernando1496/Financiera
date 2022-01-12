<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('business_line');
            $table->string('antiquity');
            $table->boolean('self_inversion');
            $table->decimal('gain',8,2);
            $table->string('other_gains')->nullable();
            $table->string('other_credits')->nullable();
            $table->decimal('credit_amount',8,2);
            $table->boolean('bad_record');
            $table->boolean('self_record');
            $table->boolean('name_giver');
            $table->boolean('family_knows');
            $table->string('how_financial');
            $table->boolean('active')->default(1);
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
        Schema::dropIfExists('surveys');
    }
}
