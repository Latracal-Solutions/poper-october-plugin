<?php namespace Poper\Poper\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreatePoperSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('poper_settings', function ($table) {
            $table->increments('id');
            $table->string('account_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('poper_settings');
    }
}
