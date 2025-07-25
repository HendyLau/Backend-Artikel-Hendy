<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
   

  Schema::create('videos', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('short_description')->nullable();
        $table->longText('content')->nullable(); 
        $table->string('url')->nullable();
        $table->enum('status', ['draft', 'published'])->default('draft');
        $table->timestamp('published_at')->nullable();
        $table->string('locale', 10)->default('en');
        $table->timestamps();
    


    
});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
