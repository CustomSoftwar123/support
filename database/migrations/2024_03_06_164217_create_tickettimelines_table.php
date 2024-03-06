<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTickettimelinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickettimelines', function (Blueprint $table) {
            $table->id();
            $table->string('ticketid', 255);
            $table->text('text');
            $table->string('useremail', 255);
            $table->string('assignedto')->nullable();
            $table->string('openedby')->nullable();
            $table->string('completedby')->nullable();
            $table->string('status', 255);
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
        Schema::dropIfExists('tickettimelines');
    }
}
