<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Resep Digital - {{ $prescription->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .header h1 {
            color: #0d6efd;
            font-size: 32px;
            margin: 0;
            padding: 0;
        }
        .header h2 {
            color: #6c757d;
            font-size: 24px;
            margin: 10px 0 20px;
            padding: 0;
        }
        .header-line {
            border-bottom: 2px solid #0d6efd;
            margin-bottom: 30px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 150px auto;
            gap: 8px;
            margin-bottom: 30px;
        }
        .info-label {
            color: #6c757d;
            font-weight: bold;
        }
        .info-value {
            color: #333;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            color: #0d6efd;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            border-bottom: 1px solid #dee2e6;
            padding-bottom: 5px;
        }
        .content {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #dee2e6;
        }
        .footer {
            margin-top: 50px;
            text-align: right;
            color: #6c757d;
            font-size: 12px;
            font-style: italic;
        }
        .prescription-no {
            font-family: 'Courier New', monospace;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>MedFast</h1>
        <h2>Resep Digital</h2>
        <div class="header-line"></div>
    </div>

    <div class="info-grid">
        <div class="info-label">No. Resep:</div>
        <div class="info-value prescription-no">#{{ str_pad($prescription->id, 6, '0', STR_PAD_LEFT) }}</div>

        <div class="info-label">Dokter:</div>
        <div class="info-value">{{ $prescription->doctor->name }}</div>

        <div class="info-label">Pasien:</div>
        <div class="info-value">{{ $prescription->patient->name }}</div>

        <div class="info-label">Tanggal Konsultasi:</div>
        <div class="info-value">{{ $prescription->appointment->appointment_date->format('d M Y H:i') }}</div>

        <div class="info-label">Berlaku Sampai:</div>
        <div class="info-value">{{ $prescription->valid_until->format('d M Y') }}</div>
    </div>

    <div class="section">
        <div class="section-title">Detail Obat & Dosis</div>
        <div class="content">
            {!! nl2br(e($prescription->medication_details)) !!}
        </div>
    </div>

    @if($prescription->instructions)
    <div class="section">
        <div class="section-title">Instruksi Penggunaan</div>
        <div class="content">
            {!! nl2br(e($prescription->instructions)) !!}
        </div>
    </div>
    @endif

    @if($prescription->notes)
    <div class="section">
        <div class="section-title">Catatan Tambahan</div>
        <div class="content">
            {!! nl2br(e($prescription->notes)) !!}
        </div>
    </div>
    @endif

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d M Y H:i:s') }}</p>
        <p>Dokumen ini digenerate secara digital dan sah tanpa tanda tangan.</p>
    </div>
</body>
</html> 