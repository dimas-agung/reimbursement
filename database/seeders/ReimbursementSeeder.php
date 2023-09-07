<?php

namespace Database\Seeders;

use App\Models\Reimbursement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReimbursementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $data = [
            [
                'date' => date('Y-m-d'),
                'name' => 'TEST',
                'nomor' => '1',
                'doc_no' => 'RE/1/'.date('Y'),
                'user_created' => 3,
                'description' => 'DATA TEST',
            ],
        ];
        Reimbursement::insert($data);  
    }
}