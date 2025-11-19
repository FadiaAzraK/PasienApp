@extends('layouts.app')
@section('title','Tambah Kunjungan')

@section('content')

<style>
    .form-card {
        background: #ffffff;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e3e7eb;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        max-width: 650px;
        margin: auto;
    }

    .form-title {
        font-size: 22px;
        font-weight: 600;
        color: #2d3436;
        margin-bottom: 20px;
    }

    .form-label {
        font-weight: 600;
        color: #636e72;
        margin-bottom: 6px;
    }

    .btn-save {
        background: #0984e3;
        border: none;
        padding: 10px 20px;
        font-weight: 600;
        border-radius: 8px;
        color: white;
    }

    .btn-save:hover {
        background: #076abd;
    }

    .btn-cancel {
        border-radius: 8px;
        font-weight: 600;
    }

</style>
<div class="form-card">
    <div class="form-title">Tambah Kunjungan</div>
    <form action="{{ route('visits.store') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label class="form-label">Pasien</label>
        <select name="patient_id" class="form-control" required>
          <option value="">-- Pilih Pasien --</option>
          @foreach($patients as $p)
            <option value="{{ $p->id }}" {{ old('patient_id')==$p->id?'selected':'' }}>
                {{ $p->name }} ({{ $p->nik }})
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Poli</label>
        <select id="department" name="department" class="form-control" required>
          <option value="">-- Pilih Poli --</option>
          @foreach(array_keys($poli) as $poliname)
            <option value="{{ $poliname }}" {{ old('department')==$poliname?'selected':'' }}>
                {{ $poliname }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Dokter</label>
        <select id="doctor_name" name="doctor_name" class="form-control" required>
          <option value="">-- Pilih Dokter --</option>
        </select>
      </div>
      <div class="mb-3">
        <label class="form-label">Tanggal Kunjungan</label>
        <input type="date" name="visit_date" value="{{ old('visit_date', date('Y-m-d')) }}" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Keluhan</label>
        <textarea name="complaint" class="form-control" rows="3">{{ old('complaint') }}</textarea>
      </div>
      <div class="mt-3 d-flex gap-2">
        <button class="btn-save">Simpan Kunjungan</button>
        <a href="{{ route('visits.index') }}" class="btn btn-secondary btn-cancel">Batal</a>
      </div>
    </form>
</div>


<script>
const poli = @json($poli);
const departmentEl = document.getElementById('department');
const doctorEl = document.getElementById('doctor_name');

function fillDoctors(){
  const selected = departmentEl.value;
  doctorEl.innerHTML = '<option value="">-- Pilih Dokter --</option>';
  if(selected && poli[selected]){
    poli[selected].forEach(d => {
      const opt = document.createElement('option');
      opt.value = d;
      opt.text = d;
      if("{{ old('doctor_name') }}" === d) opt.selected = true;
      doctorEl.appendChild(opt);
    });
  }
}
departmentEl.addEventListener('change', fillDoctors);
window.addEventListener('load', fillDoctors);
</script>

@endsection