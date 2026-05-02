<?php

namespace App\Filament\Resources\Bidangs\Schemas;

use App\Models\Bidang;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BidangInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nama'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Bidang $record): bool => $record->trashed()),
            ]);
    }
}
