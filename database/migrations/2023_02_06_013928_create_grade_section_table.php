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
        Schema::create('grade_section', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('section_id');

            $table->foreign('grade_id')->references('id')->on('grades')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('section_id')->references('id')->on('sections')
                ->onDelete('cascade')
                ->onUpdate('cascade');  
                
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
        Schema::dropIfExists('grade_section');
    }
};
