<?php

namespace App\Filament\Widgets;

use App\Models\Bidang;
use App\Models\Petugas;
use App\Models\Presensi;
use Filament\Widgets\ChartWidget;

class PresensiBidangChart extends ChartWidget
{
    // protected static ?string $heading = 'Presensi Bidang Chart';

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 3;

    public function getHeading(): string
    {
        return 'Presensi Bidang Chart ' . now()->locale('ID')->translatedFormat('d F Y');
    }

    protected function getData(): array
    {
        today()->format('D M Y');
        $labels = [];
        $values = [];

        $bidangs = Bidang::all();

        foreach ($bidangs as $key  => $bidang) {
            # code...
            $presensiBidang = Presensi::where('bidang_id', $bidang->id)->whereDate('tanggal', today())->count();
            $petugasBidang = Petugas::whereIn('seksi_id', $bidang->seksis->pluck('id'))->count();

            $labels[] = $bidang->nama;

            $values[] = round($presensiBidang / $petugasBidang * 100, 2);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Persentase Presensi (%)',
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
