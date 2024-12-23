<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('children', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')
                ->constrained('users')
                ->cascadeOnDelete();
            $table->tinyInteger('age')->unsigned();
            $table->string('grade')->nullable();
            $table->string('school_name');
            $table->text('school_address');
            $table->text('special_needs')->nullable();
            $table->string('pick_up_location')->nullable(); // Requires MySQL Spatial extension
            $table->string('drop_off_location')->nullable();
            $table->time('pick_up_time')->nullable();
            $table->time('drop_off_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('children');
    }
};
