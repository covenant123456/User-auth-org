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
        // Creating the organisations table
        Schema::create('organisations', function (Blueprint $table) {
            $table->uuid('orgId')->primary();
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Creating the organisation_user pivot table
        Schema::create('organisation_user', function (Blueprint $table) {
            $table->uuid('userId');
            $table->uuid('orgId');
            $table->foreign('userId')->references('userId')->on('users')->onDelete('cascade');
            $table->foreign('orgId')->references('orgId')->on('organisations')->onDelete('cascade');
            $table->timestamps();

            // Adding primary key for the pivot table
            $table->primary(['userId', 'orgId']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping the pivot table first to avoid foreign key constraint issues
        Schema::dropIfExists('organisation_user');
        Schema::dropIfExists('organisations');
    }
};
