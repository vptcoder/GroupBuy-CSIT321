<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupbuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groupbuys', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->string('status');
            $table->date('date_start');
            $table->date('date_end')->nullable();
            $table->unsignedInteger('min_required');
            $table->unsignedInteger('max_available');
            $table->unsignedInteger('started_by');
            $table->date('date_success')->nullable();
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
        Schema::dropIfExists('groupbuys');
    }
}
