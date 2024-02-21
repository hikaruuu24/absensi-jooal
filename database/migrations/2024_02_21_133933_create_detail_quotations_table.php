<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_quotations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')->nullable()
            ->constrained('quotations')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('item')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('markup')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('detail_quotations');
    }
}
