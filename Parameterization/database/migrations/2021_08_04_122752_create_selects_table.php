<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSelectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parameter_items_group_id')->constrained();
            $table->foreignId('sub_group_id')->nullable();

            $table->string('name');
            $table->boolean('disabled');
            $table->boolean('deleted');
            $table->timestamps();
        });

        
        Schema::table('selects', function (Blueprint $table) 
        {
            $table->foreign('sub_group_id')->references('id')->on('selects')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selects');
    }
}
