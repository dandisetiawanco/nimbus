<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('page_components', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->foreignId('component_id')->constrained()->cascadeOnDelete();
            $table->integer('order')->default(0);
            $table->json('data')->nullable(); // override data
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('page_components'); }
};