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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role_as');
            $table->string('gender')->nullable();
            $table->string('metrial_status')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('age')->nullable();
            $table->bigInteger('phone_no')->nullable();
            $table->bigInteger('workshop')->nullable();
            $table->bigInteger('emg_phone_no')->nullable();
            $table->longText('highest_qualification')->nullable();
            $table->longText('address')->nullable();
            $table->string('profile_image')->nullable();
            $table->enum('is_active',['1','0'])->default('1');
            $table->enum('is_delete',['1','0'])->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
