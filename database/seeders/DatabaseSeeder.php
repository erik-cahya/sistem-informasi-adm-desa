<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Warga;
use App\Models\Mutasi;
use App\Models\Keluarga;
use App\Models\DetailKeluarga;
use App\Models\Parameter;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
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
        $totalDataWarga = 1000; //max 42000
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

        $dusun = [
            'Dusun I','Dusun II','Dusun III','Dusun IV','Dusun V','Dusun VI'
        ];

        $faker = Faker::create('id_ID');
    	foreach (range(1,$totalDataWarga) as $index) {
            Warga::create([
                'no_ktp' => $faker->numerify('1###############'),
                'nama_lengkap' => $faker->firstName.' '.$faker->lastName,
                'agama' => $religions[rand(0, count($religions) - 1)],
                'tempat_lahir' => $faker->city(),
                'tgl_lahir' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y-m-d'),
                'jenis_kelamin' => $faker->randomElement(['Laki-laki', 'Perempuan']),
                'alamat' => $faker->address,
                'dusun' => $dusun[rand(0, count($dusun) - 1)],
                'rt' => $faker->numberBetween($min = 001, $max = 100),
                'rw' => $faker->numberBetween($min = 001, $max = 100),
                'baca_tulis' => 'iya',
                'golongan_darah' => $bloodtypes[rand(0, count($bloodtypes) - 1)],
                'warga_negara' => 'Indonesia',
                'pendidikan' => $studys[rand(0, count($studys) - 1)],
                'pekerjaan' => $faker->jobTitle,
                'status_nikah' => $maritalStatus[rand(0, count($maritalStatus) - 1)],
                'status_warga' => '1',
                'created_at' => $faker->dateTimeBetween(Carbon::now()->subYears(1), Carbon::now())->format('Y-m-d')
            ]);
        }

        //faker keluarga
        foreach (range(1,($totalDataWarga/5)) as $index){
            Keluarga::create([
                'no_kk' => $faker->numerify('2###############'),
                'alamat' => $faker->address,
                'dusun' => $dusun[rand(0, count($dusun) - 1)],
                'rt' => $faker->numberBetween($min = 001, $max = 100),
                'rw' => $faker->numberBetween($min = 001, $max = 100),
                'ekonomi' => 'A',
                'created_at' => $faker->dateTimeBetween(Carbon::now()->subYears(1), Carbon::now())->format('Y-m-d')
            ]);
        };


        //faker detailKeluarga
        $k = 1;
        foreach (range(1,($totalDataWarga/5)) as $x){
            DetailKeluarga::create([
                'keluarga_id' => $x,
                'warga_id' => $k,
                'status_anggota' => 'Kepala Keluarga'    
            ]);  
            
            DetailKeluarga::create([
                'keluarga_id' => $x,
                'warga_id' => $k = $k+1,
                'status_anggota' => 'Istri'    
            ]);

            DetailKeluarga::create([
                'keluarga_id' => $x,
                'warga_id' => $k = $k+1,
                'status_anggota' => 'Anak'    
            ]);

            DetailKeluarga::create([
                'keluarga_id' => $x,
                'warga_id' => $k = $k+1,
                'status_anggota' => 'AA'    
            ]);

            DetailKeluarga::create([
                'keluarga_id' => $x,
                'warga_id' => $k = $k+1,
                'status_anggota' => 'P'    
            ]);

           $k = $k+1;
        }

        //faker mutasi
        $jenis_mutasi_out = ['Wafat','Keluar'];
        $jenis_mutasi_in = ['Lahir','Masuk'];
        foreach (range(1,50) as $x){
            $warga_id_out = rand(1,$totalDataWarga);
            $create_date_out = $faker->dateTimeBetween(Carbon::now()->subYears(1), Carbon::now())->format('Y-m-d');
            Mutasi::create([
                    'warga_id' => $warga_id_out,
                    'jenis_mutasi' =>  $jenis_mutasi_out[rand(0, count($jenis_mutasi_out) - 1)],
                    'tgl_keluar_masuk' =>  $create_date_out ,
                    'keterangan' => '-',
                    'created_at' =>  $create_date_out
            ]);

            Warga::find($warga_id_out)->update(['status_warga' => '0']);

            $warga_id_in = rand(1,$totalDataWarga);
            $create_date_in = $faker->dateTimeBetween(Carbon::now()->subYears(1), Carbon::now())->format('Y-m-d');
            Mutasi::create([
                    'warga_id' => $warga_id_in,
                    'jenis_mutasi' =>  $jenis_mutasi_in[rand(0, count($jenis_mutasi_out) - 1)],
                    'tgl_keluar_masuk' => $create_date_in ,
                    'keterangan' => '-',
                    'created_at' => $create_date_in
            ]);
        }

    }
}
