<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('facebook')->default('https://www.facebook.com/');
            $table->string('twitter')->default('https://twitter.com/');
            $table->string('instagram')->default('https://www.instagram.com/');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->text('address')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('gender')->nullable();
            $table->text('bio')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('facebook')->default('https://www.facebook.com/');
            $table->string('twitter')->default('https://twitter.com/');
            $table->string('instagram')->default('https://www.instagram.com/');
        });
    }
};
