<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Parameter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'username' => 'admin',
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin123'),
                'status' => 1
            ],
        ];

        foreach ($users as  $u) {
            User::create($u);
        }

        $params = [
            [
                'param' => 'nama_desa',
                'value' => 'Matanga',
                'keterangan' => 'nama desa',
            ],
            [
                'param' => 'kepala_desa',
                'value' => 'ARIYANDO MATAIYA',
                'keterangan' => 'nama kepala desa',
            ],
        ];

        foreach ($params as $p) {
            Parameter::create($p);
        }
    }
}
