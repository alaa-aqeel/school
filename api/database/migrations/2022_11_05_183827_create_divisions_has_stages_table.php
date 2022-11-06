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
        Schema::create('divisions_has_stages', function (Blueprint $table) {
            
            $table->foreignId("division_id")
                ->nullable()
                ->constrained("divisions")
                ->cascadeOnDelete();

            $table->foreignId("stage_id")
                ->nullable()
                ->constrained("stages")
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('divisions_has_stages');
    }
};
