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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->string('post_slug')->unique();
            $table->string('post_thumbnail');
            $table->integer('writer_id');
            $table->integer('post_category');
            $table->integer('post_subcategory')->nullable();
            $table->longText('post_description');
            $table->string('post_status');
            $table->string('post_type');
            $table->string('post_kind');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
};
