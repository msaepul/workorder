<?php

namespace Database\Seeders;

use App\Models\Cabang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CabangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        Cabang::truncate();
    
        Schema::enableForeignKeyConstraints();
    
        $data = [
            'Padalarang', 'Tegal', 'Manado', 'Makassar'
        ];
        foreach($data as $value){
            Cabang::insert([
                'cabang'=>$value
            ]);
        }
    }
}
