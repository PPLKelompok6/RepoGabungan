@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Detail Rekam Medis</h1>
            <a href="{{ route('medical-records.index') }}" class="text-gray-600 hover:text-gray-800">
                Kembali
            </a>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Informasi Pemeriksaan</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Tanggal Pemeriksaan</p>
                        <p class="text-base">{{ $medicalRecord->record_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">
                            @if(auth()->user()->role === 'doctor')
                                Pasien
                            @else
                                Dokter
                            @endif
                        </p>
                        <p class="text-base">
                            @if(auth()->user()->role === 'doctor')
                                {{ $medicalRecord->patient->name }}
                            @else
                                {{ $medicalRecord->doctor->name }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Diagnosa</h2>
                <div class="bg-gray-50 rounded p-4">
                    <p class="text-gray-800">{{ $medicalRecord->diagnosis }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-700 mb-2">Saran</h2>
                <div class="bg-gray-50 rounded p-4">
                    <p class="text-gray-800">{{ $medicalRecord->recommendation }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 