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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('customer_english_name');
            $table->string('customer_relations')->nullable();
            $table->string('slug');
            $table->integer('village_id');
            $table->integer('laids_id');
            $table->integer('privious_total_due');
            $table->integer('payment')->nullable();
            $table->integer('current_due')->nullable();
            $table->integer('status')->default(0)->comment('0=not-attend, 1=attend');
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
        Schema::dropIfExists('customers');
    }
};
