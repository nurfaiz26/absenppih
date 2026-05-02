<?php

namespace App\Filament\Resources\Seksis\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SeksiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->required(),
                Select::make('bidang_id')
                    ->relationship('bidang', 'nama')
                    ->required(),
            ]);
    }
}
