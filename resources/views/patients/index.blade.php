@extends('layouts.app')
@section('title','Daftar Pasien')
@section('content')

<style>
.filter-card {
    background: #f8fafc;
    padding: 15px 20px;
    border-radius: 10px;
    border: 1px solid #e3e7eb;
    margin-bottom: 20px;
}
table thead {
    background: #f1f3f5;
    font-weight: 600;
}
table tbody tr:hover {
    background: #f8f9fa !important;
    transition: 0.2s;
}
.btn-custom-add {
    background: #0984e3;
    border: none;
    font-weight: 500;
}
.btn-custom-add:hover { background: #066fbb; }
.btn-custom-pdf {
    background: #d63031;
    border: none;
    font-weight: 500;
}
.btn-custom-pdf:hover { background: #b02424; }
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
.action-buttons form {
    margin: 0;
    padding: 0;
    display: inline-block;
}
.pagination {
    display: flex;
    list-style: none;
    padding: 0;
    margin: 0;
}
.page-item {
    margin-left: -1px;
}
.page-item:first-child { margin-left: 0; }
.page-item .page-link {
    display: block;
    padding: 6px 12px;
    text-decoration: none;
    color: #495057;
    transition: background 0.2s, color 0.2s;
    border: 1px solid #dee2e6;
    background-color: #fff;
}
.page-item .page-link:hover {
    background-color: #0984e3;
    color: white;
    border-color: #0984e3;
}
.page-item.active .page-link {
    background-color: #0984e3;
    color: white;
    font-weight: 500;
    border-color: #0984e3;
}
.page-item.disabled .page-link {
    color: #adb5bd;
    cursor: not-allowed;
    background-color: #f8f9fa;
}
.page-item:first-child .page-link {
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
}
.page-item:last-child .page-link {
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
</style>
<div class="filter-card d-flex flex-wrap align-items-center justify-content-between">
    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('patients.create') }}" class="btn btn-custom-add text-white">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
        <a href="{{ route('patients.export.pdf') }}" class="btn btn-custom-pdf text-white">
            <i class="bi bi-file-earmark-pdf"></i> PDF
        </a>
    </div>
    <form class="d-flex gap-1 align-items-center" method="POST" action="{{ route('patients.filter') }}">
        @csrf
        <div class="input-group">
            <input name="q" 
                   value="{{ $q ?? '' }}" 
                   class="form-control" 
                   placeholder="Cari nama atau NIK">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i>
            </button>
            @if($q)
                <a href="{{ route('patients.index', ['reset_filter' => 1]) }}" class="btn btn-outline-danger" title="Clear Filter">
                    <i class="bi bi-x-lg"></i>
                </a>
            @endif
        </div>
    </form>
</div>
<div class="table-responsive">
    <table class="table table-bordered table-striped shadow-sm">
        <thead>
            <tr class="text-center">
                <th>No</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Gender</th>
                <th>Tgl Lahir</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($patients as $i => $p)
            <tr>
                <td class="text-center">{{ $patients->firstItem() + $i }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->nik }}</td>
                <td class="text-center">{{ $p->gender }}</td>
                <td class="text-center">
                    {{ $p->birth_date ? \Carbon\Carbon::parse($p->birth_date)->format('d-m-Y') : '-' }}
                </td>
                <td class="text-center">
                    <div class="action-buttons">
                        <a href="{{ route('patients.show',$p) }}" class="btn btn-info btn-sm text-white">
                            <i class="bi bi-eye"></i> Lihat
                        </a>
                        <a href="{{ route('patients.edit',$p) }}" class="btn btn-warning btn-sm text-white">
                            <i class="bi bi-pencil"></i> Edit
                        </a>
                        <form action="{{ route('patients.destroy',$p) }}" 
                              method="POST" 
                              onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm text-white">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="mt-3 d-flex justify-content-between align-items-center">
    <div>
        {{ $patients->links('pagination::bootstrap-5') }} 
    </div>
</div>
@endsection
