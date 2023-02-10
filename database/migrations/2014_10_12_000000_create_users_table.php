<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('mandali_code');
            $table->string('mandali_name')->nullable();
            $table->text('mandali_address')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('registration_num')->nullable();
            $table->string('user_name')->unique();
            $table->string('gender');
            $table->string('lang')->nullable();
            $table->string('email')->unique();
            $table->string('mobile_number')->unique();
            $table->string('role');
            $table->string('profile_pic')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->bigInteger('created_by')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
