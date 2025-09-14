<?php

namespace Database\Seeders;

use App\Models\Drug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DrugTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Drug::create([
            'name' => 'Paracetamol',
            'supplier_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, tenetur.',
            'chemical_details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, possimus!',
            'category' => 'Antihestamines',
            'keywords' => 'paracetamol, drug, antihestamines',
            'img_path' => 'medicine.jpg',
            'price' => 6000,
        ]);

        Drug::create([
            'name' => 'Acetominafen',
            'supplier_id' => 1,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, tenetur.',
            'chemical_details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, possimus!',
            'category' => 'Analgesics',
            'keywords' => 'acetominafen, drug, analgesics',
            'img_path' => 'medicine.jpg',
            'price' => 6000,
        ]);

        Drug::create([
            'name' => 'Amoxicilina',
            'supplier_id' => 2,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, tenetur.',
            'chemical_details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, possimus!',
            'category' => 'Antibacterials',
            'keywords' => 'amoxicilina, drug, antibacterials',
            'img_path' => 'medicine.jpg',
            'price' => 10000,
        ]);

        Drug::create([
            'name' => 'Ibuprofeno',
            'supplier_id' => 3,
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum, tenetur.',
            'chemical_details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Deserunt, possimus!',
            'category' => 'Anti-Inflammatories',
            'keywords' => 'ibuprofeno, drug, antiinflammatories',
            'img_path' => 'medicine.jpg',
            'price' => 9000,
        ]);

    }
}
