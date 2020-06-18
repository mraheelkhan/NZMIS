<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewToORWDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('OutreachWorkerServiceDetails', function (Blueprint $table) {
            $table->bigInteger("SurgicalFaceMask")->nullable();
            $table->bigInteger("HandSanitizer")->nullable();
            $table->string("HandSanitizerType")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('OutreachWorkerServiceDetails', function (Blueprint $table) {
            //
        });
    }
}
