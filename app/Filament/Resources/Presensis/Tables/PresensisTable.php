<?php

namespace App\Filament\Resources\Presensis\Tables;

use App\Filament\Exports\PresensiExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class PresensisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->headerActions([
                ...(Auth::user()->name == 'Admin' ? [ExportAction::make()->exporter(PresensiExporter::class)->label('Download Data')->formats([
                    ExportFormat::Xlsx,
                ])] : [])
            ])
            ->columns([
                TextColumn::make('petugas.nama')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                TextColumn::make('seksi.nama')
                    ->searchable(),
                TextColumn::make('bidang.nama')
                    ->searchable(),
                TextColumn::make('jabatan.nama')
                    ->searchable(),
                TextColumn::make('tanggal')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('tanggal', 'desc')
            ->filters([
                ...(Auth::id() == 1 ? [TrashedFilter::make()] : []),
                Filter::make('tanggal')
                    ->form([
                        DatePicker::make('from')->label('Dari Tanggal'),
                        DatePicker::make('until')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn($query, $date) => $query->whereDate('tanggal', '>=', $date))
                            ->when($data['until'], fn($query, $date) => $query->whereDate('tanggal', '<=', $date));
                    }),

                SelectFilter::make('seksi_id')
                    ->label('Seksi')
                    ->relationship('seksi', 'nama') // tampilkan kolom nama
                    ->searchable()
                    ->preload(),

                SelectFilter::make('bidang_id')
                    ->label('Bidang')
                    ->relationship('bidang', 'nama') // tampilkan kolom nama
                    ->searchable()
                    ->preload(),

                SelectFilter::make('jabatan_id')
                    ->label('Jabatan')
                    ->relationship('jabatan', 'nama') // tampilkan kolom nama
                    ->searchable()
                    ->preload(),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Hadir' => 'Hadir',
                        'Izin' => 'Izin',
                        'Sakit' => 'Sakit'
                    ])
                    ->searchable()
                    ->preload(),
            ])
            ->recordActions([
                ...(Auth::id() == 1 ? [EditAction::make()] : []),
                ViewAction::make(),
            ])
            ->toolbarActions([
                ...(Auth::id() == 1 ? [Auth::id() == 1 ?
                    BulkActionGroup::make([
                        DeleteBulkAction::make(),
                        ForceDeleteBulkAction::make(),
                        RestoreBulkAction::make(),
                    ]) : null,] : []),
            ]);
    }
}
