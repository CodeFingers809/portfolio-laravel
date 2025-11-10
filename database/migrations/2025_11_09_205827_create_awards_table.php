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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('position'); // 1st Place, 2nd Place, Winner, etc.
            $table->string('organization');
            $table->string('date');
            $table->text('description')->nullable();
            $table->string('prize_type')->nullable(); // 'cash', 'other', null
            $table->decimal('cash_prize', 10, 2)->nullable(); // for cash prizes
            $table->string('other_prize')->nullable(); // for non-cash prizes (e.g., "MacBook Pro", "AWS Credits")
            $table->string('url')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
