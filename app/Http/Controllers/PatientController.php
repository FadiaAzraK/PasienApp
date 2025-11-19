<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class PatientController extends Controller
{
    public function filter(Request $request)
    {
        session(['patient_q' => $request->q]);

        return redirect()->route('patients.index');
    }

    public function index(Request $request)
    {
        $q = session('patient_q', $request->q);
        
        if ($request->has('q')) {
            $q = $request->q;
            session(['patient_q' => $q]);
        }
        
        if ($request->has('reset_filter')) {
            session()->forget('patient_q');
            return redirect()->route('patients.index');
        }

        $patients = Patient::query()
            ->when($q, fn($qr) =>
                $qr->where('name','like',"%$q%")
                ->orWhere('nik','like',"%$q%")
            )
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('patients.index', compact('patients','q'));
    }


    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'nik' => 'required|string|max:20|unique:patients,nik',
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        Patient::create($data);
        return redirect()->route('patients.index')->with('success','Pasien berhasil ditambahkan.');
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'nik' => 'required|string|max:20|unique:patients,nik,'.$patient->id,
            'gender' => 'required|in:L,P',
            'birth_date' => 'nullable|date',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string',
        ]);

        $patient->update($data);
        return redirect()->route('patients.index')->with('success','Data pasien diperbarui.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success','Pasien dihapus.');
    }

    public function show(Patient $patient)
    {
        $visits = $patient->visits()->orderByDesc('visit_date')->get();
        return view('patients.show', compact('patient','visits'));
    }

    public function exportPdf()
    {
        $patients = Patient::orderBy('id','DESC')->get();

        $pdf = PDF::loadView('patients.pdf', compact('patients'))
                    ->setPaper('A4', 'portrait');

        return $pdf->download('data-pasien.pdf');
    }
}