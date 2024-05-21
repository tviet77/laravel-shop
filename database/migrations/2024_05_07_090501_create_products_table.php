<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('price');
            $table->string('feature_image_path')->nullable();
            $table->string('feature_image_name')->nullable();
            $table->text('content');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->boolean('is_featured')->default(0);
            $table->string('slug')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
