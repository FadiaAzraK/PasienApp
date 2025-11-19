<?php

namespace App\Exports;

use App\Models\Visit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class VisitsExport implements 
    FromCollection, 
    WithHeadings, 
    ShouldAutoSize, 
    WithStyles, 
    WithMapping
{

    public function collection()
    {
        return Visit::with('patient')
            ->select('visit_date','patient_id','department','doctor_name','complaint')
            ->orderBy('visit_date','DESC')
            ->get();
    }
    public function map($visit): array
    {
        return [
            $visit->visit_date
            ? \Carbon\Carbon::parse($visit->visit_date)->format('d-m-Y')
            : '-',
            $visit->patient->name ?? '-',
            $visit->department,
            $visit->doctor_name,
            $visit->complaint,
        ];
    }


    public function headings(): array
    {
        return [
            'Tanggal Kunjungan',
            'Nama Pasien',
            'Poli',
            'Nama Dokter',
            'Keluhan',
        ];
    }
    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        $highestRow = $sheet->getHighestRow();

        $sheet->getStyle("A1:E{$highestRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ]
            ]
        ]);

        return [];
    }
}
