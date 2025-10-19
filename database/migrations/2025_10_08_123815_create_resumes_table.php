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
        Schema::create('resumes', function (Blueprint $table) {
$table->uuid('id')->primary();
            $table->softDeletes();
            $table->timestamps();
            $table->string("filename");            
            $table->string("fileUri");            
            $table->string( "contactDetails");            
            $table->longText("summary");            
            $table->longText("skills");            
            $table->longText("experience");            
            $table->longText("education");            
            
            //relationships
            $table->uuid("userId");            
            $table->foreign("userId")->references("id")->on('users')->onDelete("restrict");

            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resumes');
    }
};
