<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            [
                'name' => 'Спам',
            ],
            [
                'name' => 'Запрещённый товар',
            ],
            [
                'name' => 'Насилие и вражда',
            ],
            [
                'name' => 'Откровенное изображение',
            ],
            [
                'name' => 'Другое',
            ],

        ];
        DB::table('reasons')->insert($reasons);
    }
}
