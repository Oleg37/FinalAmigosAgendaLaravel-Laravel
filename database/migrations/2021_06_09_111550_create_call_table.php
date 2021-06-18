<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create('call', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('idFriend')->unsigned()->index();
            $table->foreign('idFriend')->references('id')->on('friend')->onDelete('cascade');
            $table->dateTime('callDate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void {
        Schema::dropIfExists('call');
    }
}
