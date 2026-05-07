<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
        @php
            $todayCount = App\Models\Presensi::whereDate('tanggal', Carbon\Carbon::today())->count();
            $allPetugas = App\Models\Petugas::all()->count();
            $persentase = ($todayCount/$allPetugas)*100;
        @endphp

        <a href="{{ route('filament.admin.resources.presensis.index') }}"
            class="block p-6 bg-white rounded-xl shadow hover:bg-gray-100">
            <h2 class="text-lg font-bold">Total Sudah Presensi Hari Ini: {{ $todayCount }}/{{ $allPetugas }} ({{ round($persentase, 2) }}%) Petugas</h2>
            <p style="display: flex;">Klik untuk masuk ke halaman presensi 
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="20" height="20" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778" />
                </svg>
            </p>
        </a>
    </x-filament::section>
</x-filament-widgets::widget>
