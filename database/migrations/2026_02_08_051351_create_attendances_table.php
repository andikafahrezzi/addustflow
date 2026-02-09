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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('attendance_date');

            // waktu
            $table->time('check_in_at')->nullable();
            $table->time('check_out_at')->nullable();

            // status kehadiran (hasil sistem / HR)
            $table->enum('status', [
                'present',
                'late',
                'absent',
                'leave',
                'sick',
                'permit'
            ])->default('present');

            // lokasi check-in
            $table->decimal('check_in_lat', 10, 7)->nullable();
            $table->decimal('check_in_lng', 10, 7)->nullable();

            // lokasi check-out
            $table->decimal('check_out_lat', 10, 7)->nullable();
            $table->decimal('check_out_lng', 10, 7)->nullable();

            // foto (path saja)
            $table->string('check_in_photo')->nullable();
            $table->string('check_out_photo')->nullable();

            // flag koreksi HR
            $table->boolean('is_corrected')->default(false);
            $table->text('correction_reason')->nullable();

            $table->timestamps();

            // 1 employee hanya boleh 1 record per hari
            $table->unique(['employee_id', 'attendance_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
