<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Exports\VisitsExport;
use Maatwebsite\Excel\Facades\Excel;

class VisitController extends Controller
{
    private function poliAndDoctors()
    {
        return [
            'Umum' => ['dr. Andi','dr. Siti'],
            'Gigi' => ['drg. Budi'],
            'Penyakit Dalam' => ['dr. Rusli'],
            'THT' => ['dr. Nina'],
        ];
    }
    
    public function filter(Request $request)
    {
        session(['visit_patient_id' => $request->patient_id]);
        session(['visit_department' => $request->department]);
        session(['visit_from' => $request->from]);
        session(['visit_to' => $request->to]);

        return redirect()->route('visits.index');
    }

    public function index(Request $request)
    {
        $patient_id = session('visit_patient_id');
        $department = session('visit_department');  
        $from = session('visit_from');
        $to = session('visit_to');

        if ($request->has('patient_id')) {
            $patient_id = $request->patient_id;
            session(['visit_patient_id' => $patient_id]);
        }
        if ($request->has('department')) {
            $department = $request->department;
            session(['visit_department' => $department]);
        }
        if ($request->has('from')) {
            $from = $request->from;
            session(['visit_from' => $from]);
        }
        if ($request->has('to')) {
            $to = $request->to;
            session(['visit_to' => $to]);
        }
        
        if ($request->has('reset_filter')) {
            session()->forget(['visit_patient_id', 'visit_department', 'visit_from', 'visit_to']);
            return redirect()->route('visits.index');
        }

        $patients = Patient::orderBy('name')->get();

        $visits = Visit::with('patient')
            ->when($patient_id, fn($q) => $q->where('patient_id', $patient_id))
            ->when($department, fn($q) => $q->where('department', $department))
            ->when($from, fn($q) => $q->whereDate('visit_date', '>=', $from))
            ->when($to, fn($q) => $q->whereDate('visit_date', '<=', $to))
            ->orderByDesc('visit_date')
            ->paginate(10)
            ->withQueryString();

        return view('visits.index', compact(
            'visits',
            'patients',
            'patient_id',
            'department',
            'from',
            'to'
        ));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $poli = $this->poliAndDoctors();
        return view('visits.create', compact('patients','poli'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'visit_date' => 'required|date',
            'department' => 'required|string|max:50',
            'doctor_name' => 'required|string|max:100',
            'complaint' => 'nullable|string',
        ]);

        Visit::create($data);
        return redirect()->route('visits.index')->with('success','Kunjungan tersimpan.');
    }

    public function show(Visit $visit)
    {
        return view('visits.show', compact('visit'));
    }

    public function exportExcel()
    {
        return Excel::download(new VisitsExport, 'riwayat-kunjungan.xlsx');
    }
}