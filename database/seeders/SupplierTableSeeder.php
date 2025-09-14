<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Pepito S.A',
            'email' => 'pepitosa@example.com',
            'address' => 'Cr 33 #81 A SUR 62'
        ]);

        Supplier::create([
            'name' => 'Drogueria La Nana',
            'email' => 'droglanana@gugul.com',
            'address' => 'Cl 10 #10 D 62'
        ]);

        Supplier::create([
            'name' => 'Farmacos Colombia',
            'email' => 'negocios@farmacoscolombia.com',
            'address' => 'Cl 36 A SUR # 46A-81'
        ]);
    }
}
