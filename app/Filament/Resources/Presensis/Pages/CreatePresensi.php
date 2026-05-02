<?php

namespace App\Filament\Resources\Presensis\Pages;

use App\Filament\Resources\Presensis\PresensiResource;
use App\Models\Presensi;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Validation\ValidationException;

class CreatePresensi extends CreateRecord
{
    protected static string $resource = PresensiResource::class;

    protected function beforeCreate(): void
{
    $data = $this->form->getState();

    // pastikan tanggal ada
    $tanggal = isset($data['tanggal'])
        ? Carbon::parse($data['tanggal'])->toDateString()
        : now()->toDateString();

    $exists = Presensi::where('petugas_id', $data['petugas_id'])
        ->whereDate('tanggal', $tanggal)
        ->exists();

    if ($exists) {
        Notification::make()
            ->title('Gagal')
            ->body('Anda sudah absen di tanggal tersebut')
            ->danger()
            ->send();

        $this->halt(); // ⛔ stop proses create
        
        // throw ValidationException::withMessages([
        //     'petugas_id' => 'Petugas ini sudah presensi di tanggal tersebut.',
        // ]);
    }
}
}
