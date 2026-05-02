<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['tanggal', 'seksi_id', 'bidang_id', 'petugas_id', 'jabatan_id'])]
class Presensi extends Model
{
    /** @use HasFactory<\Database\Factories\PresensiFactory> */
    use HasFactory, SoftDeletes;

    public function seksi(): BelongsTo {
        return $this->belongsTo(Seksi::class);
    }
    
    public function jabatan(): BelongsTo {
        return $this->belongsTo(Jabatan::class);
    }
    
    public function bidang(): BelongsTo {
        return $this->belongsTo(Bidang::class);
    }
    
    public function petugas(): BelongsTo {
        return $this->belongsTo(Petugas::class);
    }
}
