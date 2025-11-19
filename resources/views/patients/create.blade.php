@extends('layouts.app')
@section('title','Tambah Pasien')
@section('content')

<style>
.form-card {
    background: #ffffff;
    padding: 25px;
    border-radius: 12px;
    border: 1px solid #e3e7eb;
    box-shadow: 0 2px 6px rgba(0,0,0,0.05);
}
.form-title {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 20px;
    color: #34495e;
}
label {
    font-weight: 600;
    margin-bottom: 6px;
}
.btn-save {
    background: #0984e3;
    border: none;
    padding: 8px 18px;
    font-weight: 500;
}
.btn-save:hover { background: #066fbb; }
.btn-cancel { padding: 8px 18px; font-weight: 500; }
.gender-options {
    display: flex;
    gap: 20px;
    margin-top: 6px;
}
.gender-options input[type="radio"] {
    margin-right: 6px;
}
</style>
<div class="form-card">
    <div class="form-title">Form Tambah Pasien</div>
    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama</label>
            <input name="name" value="{{ old('name') }}" class="form-control">
            @error('name')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>NIK</label>
            <input name="nik" value="{{ old('nik') }}" class="form-control">
            @error('nik')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <div class="gender-options">
                <label>
                    <input type="radio" name="gender" value="L" {{ old('gender')=='L'?'checked':'' }}>
                    Laki-laki
                </label>
                <label>
                    <input type="radio" name="gender" value="P" {{ old('gender')=='P'?'checked':'' }}>
                    Perempuan
                </label>
            </div>
            @error('gender')<div class="text-danger small">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="birth_date" value="{{ old('birth_date') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input name="phone" value="{{ old('phone') }}" class="form-control">
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-save text-white">Simpan</button>
            <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-cancel">Batal</a>
        </div>
    </form>
</div>
@endsection