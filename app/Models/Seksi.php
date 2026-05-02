<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nama', 'bidang_id'])]
class Seksi extends Model
{
    /** @use HasFactory<\Database\Factories\SeksiFactory> */
    use HasFactory, SoftDeletes;

    public function bidang(): BelongsTo {
        return $this->belongsTo(Bidang::class);
    }
    
    public function petugases(): HasMany {
        return $this->hasMany(Petugas::class);
    }
    
    public function presensis(): HasMany {
        return $this->hasMany(Presensi::class);
    }
}
