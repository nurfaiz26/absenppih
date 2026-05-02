<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nama', 'seksi_id', 'jabatan_id'])]
class Petugas extends Model
{
    /** @use HasFactory<\Database\Factories\PetugasFactory> */
    use HasFactory, SoftDeletes;

    public function seksi(): BelongsTo {
        return $this->belongsTo(Seksi::class);
    }
    
    public function jabatan(): BelongsTo {
        return $this->belongsTo(Jabatan::class);
    }
}
