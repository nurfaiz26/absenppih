<?php

namespace App\Filament\Resources\Seksis;

use App\Filament\Resources\Seksis\Pages\CreateSeksi;
use App\Filament\Resources\Seksis\Pages\EditSeksi;
use App\Filament\Resources\Seksis\Pages\ListSeksis;
use App\Filament\Resources\Seksis\Schemas\SeksiForm;
use App\Filament\Resources\Seksis\Tables\SeksisTable;
use App\Models\Seksi;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class SeksiResource extends Resource
{
    protected static ?string $model = Seksi::class;

    protected static ?string $navigationLabel = 'Seksi';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Seksi';

    public static function form(Schema $schema): Schema
    {
        return SeksiForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SeksisTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSeksis::route('/'),
            'create' => CreateSeksi::route('/create'),
            'edit' => EditSeksi::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
