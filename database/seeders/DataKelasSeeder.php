<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MasterData\DataClasses;

class DataKelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data_kelas = [
            [
                'name' => 'RPL',
                'kelas' => [
                    'X' => [
                        '1', '2'
                    ],
                    'XI' => [
                        '1', '2'
                    ],
                    'XII' => [
                        '1', '2', '3'
                    ]
                ]
            ],
            [
                'name' => 'TITL',
                'kelas' => [
                    'X' => [
                        '1'
                    ],
                    'XI' => [
                        '1', '2'
                    ],
                    'XII' => [
                        '1'
                    ]
                ]
            ]
        ];

        // Contoh bentuk name: XII RPL 3, X RPL 1, XI TITL 2
        foreach ($data_kelas as $kelas) {
            foreach ($kelas['kelas'] as $grade => $rooms) {
                foreach ($rooms as $room) {
                    DataClasses::create([
                        'name' => $grade . ' ' . $kelas['name'] . ' ' . $room,
                        'description' => null
                    ]);
                }
            }
        }
    }
}
