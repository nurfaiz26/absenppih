<?php

namespace App\Filament\Resources\Petugas\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PetugasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Select::make('seksi_id')
                    ->relationship('seksi', 'nama')
                    ->required(),
                Select::make('jabatan_id')
                    ->relationship('jabatan', 'nama')
                    ->required(),
            ]);
    }
}
