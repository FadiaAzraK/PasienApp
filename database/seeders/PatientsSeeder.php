<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Patient;
use App\Models\Visit;

class PatientsSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Visit::truncate(); 
        Patient::truncate();
        Schema::enableForeignKeyConstraints();

        $samples = [
            [
                'name'=>'Ilham',
                'nik'=>'1234567890109876',
                'gender'=>'L',
                'birth_date'=>'1990-02-02',
                'phone'=>'081234567877',
                'address'=>'Jl. Merdeka 12'
            ],
            [
                'name'=>'Indah',
                'nik'=>'3210987654329999',
                'gender'=>'P',
                'birth_date'=>'1995-05-19',
                'phone'=>'082345678934',
                'address'=>'Jl. Mawar 25'
            ],
            [
                'name'=>'Lala',
                'nik'=>'3210987654326666',
                'gender'=>'P',
                'birth_date'=>'1995-05-27',
                'phone'=>'082345678925',
                'address'=>'Jl. Mawar 22'
            ],
            [
                'name'=>'Fikri',
                'nik'=>'3210987654325555',
                'gender'=>'L',
                'birth_date'=>'1995-05-23',
                'phone'=>'082345678937',
                'address'=>'Jl. Mawar 23'
            ],
            [
                'name'=>'Tata',
                'nik'=>'3210987654324444',
                'gender'=>'P',
                'birth_date'=>'1995-05-19',
                'phone'=>'082345678938',
                'address'=>'Jl. Mawar 24'
            ],
            [
                'name'=>'Michelle',
                'nik'=>'3210987654322222',
                'gender'=>'P',
                'birth_date'=>'1995-05-30',
                'phone'=>'082345678980',
                'address'=>'Jl. Mawar 20'
            ],
            [
                'name'=>'Marsha',
                'nik'=>'3210987654327654',
                'gender'=>'P',
                'birth_date'=>'1995-05-11',
                'phone'=>'082345678969',
                'address'=>'Jl. Mawar 21'
            ],
            [
                'name'=>'Greesel',
                'nik'=>'3210987654320954',
                'gender'=>'P',
                'birth_date'=>'1995-05-02',
                'phone'=>'082345678966',
                'address'=>'Jl. Mawar 28'
            ],
        ];

        foreach($samples as $s){
            Patient::create($s);
        }

    }
}
