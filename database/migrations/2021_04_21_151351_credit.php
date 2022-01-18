<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Credit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credits', function (Blueprint $table) {
            $table->id();
            $table->string('individual_credit')->nullable();
            $table->string('seller_credit')->nullable();
            $table->string('aditional_credit')->nullable();
            $table->string('renovation_credit')->nullable();
            $table->string('insurance_credit')->nullable();
            $table->string('guarantee')->nullable();
            //1.- Datos del cliente
            $table->integer('num_credit');
            $table->string('type_id');
            $table->string('num_id')->nullable();
            $table->string('auth_date');
            $table->boolean('civil_state');
            $table->string('regimen');
            $table->boolean('current_house');
            $table->string('economic');
            //1.1.- Datos de la pareja
            $table->string('nombre_conyuge')->nullable();
            $table->string('apellidos_conyuge')->nullable();
            $table->string('celular_conyuge')->nullable();
            $table->string('calle_conyuge')->nullable();
            $table->string('colonia_conyuge')->nullable();
            $table->string('codigo_postal_conyuge')->nullable();
            //2.- Datos del negocio
            $table->string('nombre_negocio');
            $table->string('actividad_negocio');
            $table->string('tiempo_negocio');
            $table->string('telefono_negocio');
            $table->string('calle_negocio');
            $table->string('colonia_negocio');
            $table->string('ganacia_negocio');
            $table->string('gastos_negocio');
            $table->string('negocio');
            //$table->string('NRP');
            //$table->time('schedule_in');
            //$table->time('schedule_out');
            //$table->string('last_name2');
            //$table->string('second_last_name2');
            //$table->string('name2');
            //$table->string('phone2');
            //$table->string('cellphone2');
            //$table->string('last_name3');
            //$table->string('second_last_name3');
            //$table->string('name3');
            //$table->string('phone3');
            //$table->string('cellphone3');
            //3.- Aval y garantia
            $table->string('last_name_aval')->nullable();
            $table->string('second_last_name_aval')->nullable();
            $table->string('name_aval')->nullable();
            $table->string('phone_aval')->nullable();
            $table->string('type_warranty')->nullable();
            $table->string('description_warranty')->nullable();
            $table->string('model_warranty')->nullable();
            $table->string('serie_warranty')->nullable();
            $table->string('placa_warranty')->nullable();
            $table->string('color_warranty')->nullable();
            //4.- Datos para determinar el monto de credito
            $table->integer('pension');
            $table->double('interes',8,2);
            $table->string('time_Credit');
            $table->double('want_credit',8,2);
            $table->double('check_credit',8,2);
            $table->double('total_credit',8,2);
            $table->double('amountPay',8,2);
            //5.- Datos para obono en cuenta de credito
            $table->string('bank_name')->nullable();
            $table->string('credit_bank_number')->nullable();
            $table->string('credit_bank_key')->nullable();
            $table->string('rfc_bank')->nullable();
            $table->string('email_bank')->nullable();
            //$table->string('city_of')->nullable();
            //datos de?
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->boolean('status')->nullable();
            $table->boolean('payment_status')->nullable();
            $table->string('fileName')->nullable();
            $table->string('url')->nullable();
            $table->longText('address')->nullable();
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
        Schema::dropIfExists('credits');
    }
}
