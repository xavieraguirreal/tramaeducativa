<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('featured_image')->nullable();
            $table->string('featured_image_caption')->nullable();

            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('author_id')->constrained()->onDelete('cascade');

            $table->enum('status', ['draft', 'review', 'published'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('views')->default(0);

            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'is_featured', 'published_at']);
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
