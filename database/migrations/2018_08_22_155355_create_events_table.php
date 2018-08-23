<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('title', 400);
            $table->date('date')->index();
            $table->longText('description');
            $table->string('contact_email', 200);

            $table->time('time')->nullable(true)->default(null)->index();
            $table->string('location', 400)->nullable(true)->default(null);
            $table->string('costs', 200)->nullable(true)->default(null);
            $table->boolean('registration_required')->default(false);
            $table->string('registration_email', 200)->nullable(true)->default(null);
            $table->string('registration_tel', 100)->nullable(true)->default(null);
            $table->string('registration_url', 400)->nullable(true)->default(null);
            $table->string('contact_name', 400)->nullable(true)->default(null);
            $table->string('contact_tel', 100)->nullable(true)->default(null);

            $table->char('edit_token', 64);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
