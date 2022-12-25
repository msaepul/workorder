<?php

namespace Database\Seeders;

use App\Models\Departemen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

    Departemen::truncate();

    Schema::enableForeignKeyConstraints();

    $data = [
        'Marketing', 'Perencanaan', 'Produksi', 'Gudang Produk Jadi'
    ];
    foreach($data as $value){
        Departemen::insert([
            'departemen'=>$value
            
        ]);
    }
    }
}
