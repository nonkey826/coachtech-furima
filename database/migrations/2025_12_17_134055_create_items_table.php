<<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
    $table->id();

    $table->foreignId('user_id')->constrained()->cascadeOnDelete();

    $table->string('title');
    $table->text('description');
    $table->integer('price');

    $table->string('image')->nullable();
    $table->string('category');
    $table->string('status');
    $table->string('brand')->nullable();

    $table->boolean('is_sold')->default(false);
    $table->foreignId('buyer_id')->nullable()->constrained('users');

    $table->timestamps();
});


    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
