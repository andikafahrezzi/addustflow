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
Schema::create('projects', function (Blueprint $table) {
    $table->id();
    $table->foreignId('proposal_id')->constrained()->cascadeOnDelete();
    $table->foreignId('client_id')->constrained()->cascadeOnDelete();
    $table->string('name');
    $table->decimal('contract_value', 15, 2);
    $table->date('start_date')->nullable();
    $table->date('end_date')->nullable();
    $table->enum('status', ['planned','running','completed','cancelled'])->default('planned');
    $table->foreignId('manager_id')->constrained('users');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
