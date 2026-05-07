<?php

namespace App\Filament\Widgets;

use App\Models\Presensi;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\Widget;

class PresensiWidget extends Widget
{
    protected string $view = 'filament.widgets.presensi-widget';
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $todayCount = Presensi::whereDate('tanggal', Carbon::today())->count();

        return [
            Stat::make('Presensi Hari Ini', $todayCount)
                ->description('Klik untuk lihat data presensi')
                ->icon('heroicon-o-user-group')
                ->color('success')
                ->url(route('filament.admin.resources.presensis.index'))
                ->openUrlInNewTab(false),
        ];
    }
}
