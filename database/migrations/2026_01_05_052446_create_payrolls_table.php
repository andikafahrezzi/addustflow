<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();

            // contoh: 2025-02
            $table->string('period');

            // status alur payroll
            $table->enum('status', ['draft','approved','paid'])->default('draft');

            // HR yang generate payroll
            $table->foreignId('generated_by')
                ->constrained('users')
                ->cascadeOnDelete();

            // Finance yang approve
            $table->foreignId('approved_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
