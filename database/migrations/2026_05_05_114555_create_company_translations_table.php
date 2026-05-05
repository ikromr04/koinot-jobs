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
    Schema::create('company_translations', function (Blueprint $table) {
      $table->id();

      $table->foreignId('company_id')
        ->constrained()
        ->cascadeOnDelete();

      $table->string('locale', 5);
      $table->string('name');
      $table->string('logo');

      $table->unique(['company_id', 'locale']);
      $table->index(['locale', 'company_id']);

      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('company_translations');
  }
};
