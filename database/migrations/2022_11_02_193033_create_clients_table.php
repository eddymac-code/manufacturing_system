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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->enum('source', array('online', 'admin'))->default('admin')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender');
            $table->string('unique_no')->nullable();
            $table->string('country')->nullable();
            $table->string('mobile')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('title')->nullable();
            $table->string('business_name')->nullable();
            $table->string('photo')->nullable();
            $table->text('files')->nullable();
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
        Schema::dropIfExists('clients');
    }
};
