<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Client extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('rfc')->unique();
            $table->string('curp')->unique();
            $table->string('phone');
            $table->string('cellphone');
            $table->string('genre');
            $table->string('int_number');
            $table->string('ext_number');
            $table->string('street');
            $table->string('suburb');
            $table->string('postal_code');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->boolean('status_credit')->default(false);
            $table->string('imgClient');
            $table->string('visit_status');
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
        Schema::dropIfExists('clients');
    }
}
