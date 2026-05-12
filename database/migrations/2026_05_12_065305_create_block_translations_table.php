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
        Schema::create('block_translations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('block_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('locale', 5);
            $table->text('title');
            $table->text('content');
            $table->string('image')->nullable();

            $table->unique(['block_id', 'locale']);
            $table->index(['locale', 'block_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_translations');
    }
};
