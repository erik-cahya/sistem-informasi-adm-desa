<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
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

        //faker data warga
        $religions = [
            'Islam',
            'Protestan',
            'Katolik',
            'Hindu',
            'Khonghucu',
            'Buddha',
            'Penghayat Kepercayaan'
        ];

        $bloodtypes = [
            '-',
            'O',
            'A',
            'B',
            'AB'
        ];

        $studys = [
            'TIDAK/BELUM SEKOLAH',
            'BELUM TAMAT SD/SEDERAJAT',
            'TAMAT SD/SEDERAJAT',
            'SLTP/SEDERAJAT',
            'SLTA/SEDERAJAT',
            'DIPLOMA I/II',
            'AKADEMI/DIPLOMA III/S. MUDA',
            'STRATA II',
            'STRATA III'
        ];

        $maritalStatus = [
            'Belum Kawin',
            'Kawin',
            'Cerai mati',
            'Cerai hidup'
        ];

        $faker = Faker::create('id_ID');
    	foreach (range(1,500) as $index) {
            Warga::create([
                'no_ktp' => $faker->numerify('################'),
                'nama_lengkap' => $faker->firstName.' '.$faker->lastName,
                'agama' => $religions[rand(0, count($religions) - 1)],
                'tempat_lahir' => $faker->city(),
                'tgl_lahir' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y-m-d'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'dusun' => $faker->citySuffix,
                'rt' => $faker->numberBetween($min = 001, $max = 100),
                'rw' => $faker->numberBetween($min = 001, $max = 100),
                'golongan_darah' => $bloodtypes[rand(0, count($bloodtypes) - 1)],
                'warga_negara' => 'Indonesia',
                'pendidikan' => $studys[rand(0, count($studys) - 1)],
                'pekerjaan' => $faker->jobTitle,
                'status_nikah' => $maritalStatus[rand(0, count($maritalStatus) - 1)],
                'status_warga' => $faker->randomElement(['1', '0'])
            ]);
        }

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
