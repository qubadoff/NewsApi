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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->bigInteger('author_id');
            $table->text("title")->index();
            $table->mediumText("excerpt")->nullable();
            $table->mediumText("meta_description")->nullable();
            $table->mediumText("meta_tags")->nullable();
            $table->longText("body");
            $table->text("cover_image")->nullable();
            $table->text("slug")->nullable();
            $table->text("status");
            $table->text("is_future")->default("false");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
