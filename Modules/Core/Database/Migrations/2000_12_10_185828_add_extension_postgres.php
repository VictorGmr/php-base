<?php
//https://github.com/tpetry/laravel-postgresql-enhanced

use Illuminate\Database\Migrations\Migration;
use Tpetry\PostgresqlEnhanced\Support\Facades\Schema;

class AddExtensionPostgres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::createExtensionIfNotExists('citext');
        Schema::createExtensionIfNotExists('unaccent');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropExtensionIfExists('citext');
        //Schema::dropExtensionIfExists('unaccent');
    }
}
