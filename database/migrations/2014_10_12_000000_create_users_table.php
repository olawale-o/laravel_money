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
            $table->string('account_number')->unique()->nullable();
            $table->string('first_name')->default('first name');
            $table->string('last_name')->default('last name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('address')->default('address');
            $table->date('dob')->default('1990-01-01');
            $table->string('pic_url')->default('profil.png');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->foreignId('account_type_id')->constrained('account_types');
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
