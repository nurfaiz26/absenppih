<?php

namespace App\Filament\Widgets;

use App\Models\Presensi;
use Carbon\Carbon;
use Filament\Widgets\ChartWidget;

class PresensiChart extends ChartWidget
{
    protected ?string $heading = 'Presensi Harian Embarkasi';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $labels = [];
        $values = [];

        for ($i = 0; $i < 30; $i++) {
            // for ($i = 30; $i >= 0; $i--) {
            // $date = now()->subDays($i);
            $date = Carbon::createFromDate(2026, 4, 21);
            $date->addDays($i);

            $labels[] = $date->format('d M');

            $values[] = Presensi::whereDate(
                'tanggal',
                $date
            )->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Presensi',
                    'data' => $values,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
