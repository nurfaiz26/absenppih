<?php

use App\Models\Bidang;
use App\Models\Jabatan;
use App\Models\Petugas;
use App\Models\Seksi;
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
        Schema::create('presensis', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Petugas::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Seksi::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Bidang::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Jabatan::class)->constrained()->cascadeOnDelete();
            $table->enum('status', ['Hadir', 'Izin', 'Sakit']);
            $table->timestamp('tanggal');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensis');
    }
};
