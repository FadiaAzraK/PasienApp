@extends('layouts.app')
@section('title','Riwayat Kunjungan')
@section('content')

<style>
.filter-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e3e7eb;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    margin-bottom: 20px;
}
.btn-export {
    background: #27ae60;
    color: white;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
}
.btn-export:hover { background: #1e8f4d; }
.btn-add {
    background: #0984e3;
    color: white;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
}
.btn-add:hover { background: #0769b3; }
table thead {
    background: #f5f6fa;
    font-weight: 600;
}
table tbody tr:hover {
    background: #f1f3f5;
    transition: .2s;
}
.table-wrapper {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    border: 1px solid #e3e7eb;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 4px;
    flex-wrap: nowrap;
}
.action-buttons .btn {
    padding: 4px 6px;
    font-size: 11px;
    display: flex;
    align-items: center;
    gap: 3px;
    white-space: nowrap;
}
</style>
<div class="filter-card d-flex flex-wrap align-items-end justify-content-between">
    <div class="d-flex flex-wrap gap-2 align-items-end">
        <form class="row g-2 align-items-end" method="POST" action="{{ route('visits.filter') }}">
            @csrf
            <div class="col-auto">
                <select name="patient_id" class="form-select">
                    <option value="">Pilih Pasien</option>
                    @foreach($patients as $p)
                        <option value="{{ $p->id }}" {{ ($patient_id ?? '') == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <select name="department" class="form-select">
                    <option value="">Pilih Poli</option>
                    <option value="Umum" {{ ($department ?? '')=='Umum'?'selected':'' }}>Umum</option>
                    <option value="Gigi" {{ ($department ?? '')=='Gigi'?'selected':'' }}>Gigi</option>
                    <option value="Penyakit Dalam" {{ ($department ?? '')=='Penyakit Dalam'?'selected':'' }}>Penyakit Dalam</option>
                    <option value="THT" {{ ($department ?? '')=='THT'?'selected':'' }}>THT</option>
                </select>
            </div>
            <div class="col-auto">
                <input type="date" name="from" value="{{ $from ?? '' }}" class="form-control">
            </div>
            <div class="col-auto">
                <input type="date" name="to" value="{{ $to ?? '' }}" class="form-control">
            </div>
            <div class="col-auto d-grid">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-funnel"></i>
                </button>
            </div>
            @if($patient_id || $department || $from || $to)
                <div class="col-auto d-grid">
                    <a href="{{ route('visits.index', ['reset_filter' => 1]) }}" class="btn btn-outline-danger" title="Clear Filter">
                        <i class="bi bi-x-lg"></i>
                    </a>
                </div>
            @endif
        </form>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('visits.export.excel') }}" class="btn btn-export">
            <i class="bi bi-file-earmark-excel"></i> Export Excel
        </a>
    </div>
</div>
<div class="table-wrapper">
    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Pasien</th>
                <th>Poli</th>
                <th>Dokter</th>
                <th>Keluhan</th>
                <th width="90">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($visits as $v)
            <tr>
                <td>{{ \Carbon\Carbon::parse($v->visit_date)->format('d-m-Y') }}</td>
                <td>{{ $v->patient->name }}</td>
                <td>{{ $v->department }}</td>
                <td>{{ $v->doctor_name }}</td>
                <td>{{ \Illuminate\Support\Str::limit($v->complaint,60) }}</td>
                <td>
                    <div class="action-buttons">
                        <a href="{{ route('visits.show', $v) }}" class="btn btn-sm btn-info text-white">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">  
        {{ $visits->links('pagination::bootstrap-5') }} 
    </div>
</div>
@endsection
