<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatastroDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catastro_data', function (Blueprint $table) {
            $table->decimal("fid")->nullable();
            $table->text("geo_shape")->nullable();
            $table->string("call_numero")->nullable();
            $table->string("codigo_postal", 6)->nullable();
            $table->string("colonia_predio")->nullable();
            $table->double("superficie_terreno",10, 1);
            $table->double("superficie_construccion",10, 1);
            $table->string("uso_construccion")->nullable();
            $table->char("clave_rango_nivel", 2)->nullable();
            $table->integer("anio_construccion")->nullable();
            $table->string("instalaciones_especiales")->nullable();
            $table->double("valor_unitario_suelo",10,2)->nullable();
            $table->double("valor_suelo",10,2)->nullable();
            $table->string("clave_valor_unitario_suelo", 7)->nullable();
            $table->string("colonia_cumpliemiento");
            $table->string("alcaldia_cumplimiento");
            $table->double("subsidio", 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catastro_data');
    }
}
//fid,geo_shape,call_numero,codigo_postal,colonia_predio,superficie_terreno,superficie_construccion,uso_construccion,clave_rango_nivel,anio_construccion,instalaciones_especiales,valor_unitario_suelo,valor_suelo,clave_valor_unitario_suelo,colonia_cumpliemiento,alcaldia_cumplimiento,subsidio
//429222,"{""type"":""MultiPolygon"",""coordinates"":[[[[-99.1265884125282,19.4803896329241],[-99.1265824944111,19.4804104364662],[-99.1265788158452,19.4804233393555],[-99.1265656835277,19.4804694972129],[-99.1264978065839,19.4804534181176],[-99.1264600739046,19.480444470221],[-99.1264430404033,19.4804404391381],[-99.1264364326639,19.4804388664814],[-99.1264219686608,19.4804016872752],[-99.1264239886942,19.4803959266578],[-99.1264263231638,19.4803892811814],[-99.1264407397152,19.4803481803495],[-99.1264701219351,19.4803564220791],[-99.1265027984693,19.4803655946072],[-99.1265187082849,19.4803700679013],[-99.1265515276425,19.4803792765715],[-99.1265677040532,19.4803838221589],[-99.1265884125282,19.4803896329241]]]]}",
//  Euzcaro 178 a,07800,Industrial,152.0,455.0,Habitacional,05,1966,SÃ­,3138.07,476986.64,A070394,INDUSTRIAL,GUSTAVO A. MADERO,.00