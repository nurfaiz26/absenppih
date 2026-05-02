<?php

namespace App\Filament\Resources\Presensis\Schemas;

// use Filament\Forms\Components\Builder;

use App\Models\Presensi;
use Illuminate\Database\Eloquent\Builder; // ✅ BENAR
use Illuminate\Database\Query\Builder as QBuilder; // ✅ BENAR
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class PresensiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('bidang_id')
                    ->relationship('bidang', 'nama', fn($query, $get) =>
                    $query->when(Auth::id() == 2, function ($query) {
                        return $query->where('id', 11);
                    })->when(Auth::id() == 3, function ($query) {
                        return $query->where('id', '!=', 11);
                    }))
                    ->default(function () {
                        return Auth::id() === 2 ? 11 : null;
                    })
                    ->disabled(function () {
                        return Auth::id() === 2;
                    })
                    ->dehydrated()
                    ->reactive()
                    ->afterStateUpdated(fn($set) => $set('seksi_id', null)),

                Select::make('seksi_id')
                    ->relationship(
                        'seksi',
                        'nama',
                        fn($query, $get) =>
                        $query->where('bidang_id', $get('bidang_id'))->when(Auth::id() == 2, function ($query) {
                            return $query->where('id', 23);
                        })->when(Auth::id() == 3, function ($query) {
                            return $query->where('id', '!=', 23);
                        })
                    )
                    ->default(function () {
                        return Auth::id() === 2 ? 23 : null;
                    })
                    ->disabled(function ($get) {
                        return Auth::id() === 2 || !$get('bidang_id');
                    })
                    ->reactive()
                    ->dehydrated()
                    ->afterStateUpdated(fn($set) => $set('petugas_id', null)),
                    // ->disabled(fn($get) => !$get('bidang_id')),

                Select::make('petugas_id')
                    ->label('Petugas')
                    ->relationship(
                        'petugas',
                        'nama',
                        fn(Builder $query, callable $get) =>
                        $query->where('seksi_id', $get('seksi_id'))
                    )
                    ->searchable()
                    ->preload()
                    ->disabled(fn(callable $get) => !$get('seksi_id')) // ⛔ disable kalau belum pilih seksi
                    ->required(),
                Select::make('jabatan_id')
                    ->label('Jabatan')
                    ->relationship(
                        'jabatan',
                        'nama',
                        fn(Builder $query) =>
                        Auth::id() === 2
                            ? $query->where('id', '!=', 1)
                            : $query
                    )
                    ->required()
                    ->default(function () {
                        return Auth::id() === 3 ? 1 : null;
                    })
                    ->disabled(function () {
                        return Auth::id() === 3;
                    })
                    ->dehydrated(), // tetap dikirim ke database walau disabled
                DateTimePicker::make('tanggal')
                    ->required(),
            ]);
    }
}
