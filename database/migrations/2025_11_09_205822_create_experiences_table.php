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
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('organization');
            $table->string('location')->nullable();
            $table->string('start_date');
            $table->string('end_date')->nullable();
            $table->boolean('current')->default(false);
            $table->text('description')->nullable();
            $table->json('achievements')->nullable(); // array of achievements
            $table->string('type')->default('work'); // work, leadership, volunteer
            $table->string('url')->nullable(); // link to paper, website, etc.
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
