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
            $table->increments('id');
            
            $table->enum('role', ['Super Admin', 'Admin', 'Patient', 'Nurse', 'Receptionist', 'Imaging', 'Laboratory', 'Cashier'])->nullable();
            $table->string('clinic_id')->nullable();

            $table->string('fname')->nullable();
            $table->string('mname')->nullable();
            $table->string('lname')->nullable();
            $table->string('suffix')->nullable();
            
            $table->string('email')->nullable();
            $table->string('contact')->nullable();

            $table->date('birthday')->nullable();
            $table->string('gender')->nullable();

            $table->text('address')->nullable();

            $table->timestamp('tnc_agreement')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('avatar')->default('images/default_avatar.png');
            
            $table->string('username');
            $table->string('password');

            $table->timestamps();
            $table->softDeletes();
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
