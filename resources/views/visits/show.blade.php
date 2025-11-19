@extends('layouts.app')
@section('title','Detail Kunjungan')
@section('content')

<style>
    .visit-detail-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e3e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .visit-title {
        font-size: 22px;
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 20px;
    }

    .detail-label {
        font-weight: 600;
        color: #636e72;
        width: 120px;
    }

    .detail-row {
        padding: 10px 0;
        border-bottom: 1px dashed #e0e0e0;
    }

    .back-btn {
        background: #b2bec3;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
    }

    .back-btn:hover {
        background: #939fa3;
    }

    .badge-poli {
        background: #0984e3;
        padding: 6px 12px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 13px;
    }
</style>
<div class="visit-detail-card">
    <div class="visit-title">Detail Kunjungan</div>
    <div class="detail-row d-flex">
        <div class="detail-label">Tanggal</div>
        <div>{{ \Carbon\Carbon::parse($visit->visit_date)->format('d-m-Y') }}</div>
    </div>
    <div class="detail-row d-flex">
        <div class="detail-label">Pasien</div>
        <div>
            {{ $visit->patient->name }}
            <span class="text-muted">({{ $visit->patient->nik }})</span>
        </div>
    </div>
    <div class="detail-row d-flex">
        <div class="detail-label">Poli</div>
        <div>
            <span class="badge-poli">{{ $visit->department }}</span>
        </div>
    </div>
    <div class="detail-row d-flex">
        <div class="detail-label">Dokter</div>
        <div>{{ $visit->doctor_name }}</div>
    </div>
    <div class="detail-row d-flex" style="border-bottom: none;">
        <div class="detail-label">Keluhan</div>
        <div>{{ $visit->complaint }}</div>
    </div>
    <div class="mt-4">
        <a href="{{ route('visits.index') }}" class="back-btn">
            Kembali
        </a>
    </div>
</div>
@endsection
