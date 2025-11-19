@extends('layouts.app')
@section('title','Detail Pasien')
@section('content')

<style>
    .profile-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e3e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        margin-bottom: 20px;
    }

    .profile-title {
        font-size: 22px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #2d3436;
    }

    .info-label {
        font-weight: 600;
        color: #636e72;
    }

    .visit-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid #e3e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .visit-header {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 12px;
        color: #2d3436;
    }

    .visit-item {
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 10px;
        background: #f8fafc;
    }

    .visit-item:hover {
        background: #f1f3f5;
        transition: .2s;
    }

    .gender-badge {
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        color: white;
        display: inline-block;
    }

    .gender-l {
        background: #0984e3;
    }

    .gender-p {
        background: #d63031;
    }
</style>
<div class="mb-3">
    <a href="{{ route('patients.index') }}" class="btn btn-back">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>
<div class="row">
    <div class="col-md-5">
        <div class="profile-card">
            <div class="profile-title">
                {{ $patient->name }}
            </div>
            <p><span class="info-label">NIK:</span> {{ $patient->nik }}</p>
            <p>
                <span class="info-label">Gender:</span>
                <span class="gender-badge {{ $patient->gender == 'L' ? 'gender-l' : 'gender-p' }}">
                    {{ $patient->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                </span>
            </p>
            <p>
                <span class="info-label">Tgl Lahir:</span>
                {{ $patient->birth_date ? \Carbon\Carbon::parse($patient->birth_date)->format('d-m-Y') : '-' }}
            </p>
            <p><span class="info-label">Telepon:</span> {{ $patient->phone ?: '-' }}</p>
            <p><span class="info-label">Alamat:</span> {{ $patient->address ?: '-' }}</p>
        </div>
    </div>
    <div class="col-md-7">
        <div class="visit-card">
            <div class="visit-header">Riwayat Kunjungan</div>
            @if($visits->isEmpty())
                <div class="text-muted">Belum ada kunjungan.</div>
            @else
                @foreach($visits as $v)
                    <div class="visit-item">
                        <strong>{{ \Carbon\Carbon::parse($v->visit_date)->format('d-m-Y') }}</strong>
                        — {{ $v->department }} ({{ $v->doctor_name }})

                        <div class="small text-muted mt-1">
                            {{ \Illuminate\Support\Str::limit($v->complaint, 80) }}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection