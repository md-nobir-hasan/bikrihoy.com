<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('reviewer_name')->nullable();
            $table->string('rating')->nullable();
            $table->string('review_text')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }
    

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
