<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJauthTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $prefix = "";
        Schema::create($prefix . 'login_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("type");
            $table->ipAddress("login_ip");
            $table->string("ua");
            $table->json("data");
            $table->timestamps();
        });
        Schema::create($prefix . 'oauth2_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();
            $table->string("type")->constrained();
            $table->json("data")->nullable();
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
        Schema::dropIfExists('login_records');
        Schema::dropIfExists('oauth2_records');
    }
}
