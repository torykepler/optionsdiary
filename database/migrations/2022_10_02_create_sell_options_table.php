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
    public function up(): void
    {
        Schema::create('sell_options', function (Blueprint $table) {
            $table->id();
            $table->string('ticker')->index();
            $table->integer('user_id');
            $table->date('open_date');
            $table->date('exp_date');
            $table->date('close_date')->nullable();
            $table->string('type');
            $table->decimal('strike');
            $table->decimal('premium');
            $table->decimal('exit_price')->nullable();
            $table->decimal('fees');
            $table->integer('quantity');
            $table->dateTime('updated_at');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('sell_options');
    }
};
