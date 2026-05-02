<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nama'])]
class Bidang extends Model
{
    /** @use HasFactory<\Database\Factories\BidangFactory> */
    use HasFactory, SoftDeletes;

    public function presensis(): HasMany {
        return $this->hasMany(Presensi::class);
    }
    
    public function seksis(): HasMany {
        return $this->hasMany(Seksi::class);
    }
}
