<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FruitSeeder extends Seeder
{
    public function run()
    {
        $fruits = [
            ['name' => 'Maçã', 'price' => 75.00, 'image' => 'https://images.unsplash.com/photo-1630563451961-ac2ff27616ab?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Maçã fresca e crocante.', 'category' => 'Frutas Vermelhas'],

            ['name' => 'Banana', 'price' => 40.00, 'image' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11b08e?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=580', 'description' => 'Bananas maduras e doces.', 'category' => 'Frutas Tropicais'],

            ['name' => 'Laranja', 'price' => 60.00, 'image' => 'https://images.unsplash.com/photo-1702040242527-1be3acf5a0b3?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435', 'description' => 'Laranjas suculentas e frescas.', 'category' => 'Cítricas'],

            ['name' => 'Pera', 'price' => 55.00, 'image' => 'https://images.unsplash.com/photo-1570115114436-63d3405246e7?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Peras doces e suculentas.', 'category' => 'Frutas Verdes'],

            ['name' => 'Manga', 'price' => 90.00, 'image' => 'https://images.unsplash.com/photo-1601493700631-2b16ec4b4716?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=435', 'description' => 'Manga tropical madura.', 'category' => 'Frutas Tropicais'],

            ['name' => 'Uva', 'price' => 65.00, 'image' => 'https://images.unsplash.com/photo-1596363505729-4190a9506133?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Uvas frescas e doces.', 'category' => 'Frutas Vermelhas'],

            ['name' => 'Abacaxi', 'price' => 120.00, 'image' => 'https://images.unsplash.com/photo-1589820296156-2454bb8a6ad1?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Abacaxi doce e suculento.', 'category' => 'Frutas Tropicais'],

            ['name' => 'Morango', 'price' => 85.00, 'image' => 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=415', 'description' => 'Morangos frescos e doces.', 'category' => 'Frutas Vermelhas'],

            ['name' => 'Kiwi', 'price' => 70.00, 'image' => 'https://images.unsplash.com/photo-1679065103638-7360cb935fac?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=327', 'description' => 'Kiwi fresco e ácido.', 'category' => 'Frutas Exóticas'],

            ['name' => 'Melancia', 'price' => 95.00, 'image' => 'https://images.unsplash.com/photo-1587049352846-4a222e784d38?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=580', 'description' => 'Melancia suculenta e refrescante.', 'category' => 'Frutas Tropicais'],

            ['name' => 'Limão', 'price' => 30.00, 'image' => 'https://images.unsplash.com/photo-1596181525841-8e8bae173eb0?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Limão fresco e ácido.', 'category' => 'Cítricas'],

            ['name' => 'Coco', 'price' => 80.00, 'image' => 'https://images.unsplash.com/photo-1560769680-ba2f3767c785?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=464', 'description' => 'Coco natural e refrescante.', 'category' => 'Frutas Tropicais'],

            ['name' => 'Pêssego', 'price' => 75.00, 'image' => 'https://images.unsplash.com/photo-1629828874514-c1e5103f2150?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Pêssego suculento e doce.', 'category' => 'Frutas Verdes'],

            ['name' => 'Ameixa', 'price' => 65.00, 'image' => 'https://images.unsplash.com/photo-1564750497011-ead0ce4b9448?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=387', 'description' => 'Ameixas doces e suculentas.', 'category' => 'Frutas Vermelhas'],

            ['name' => 'Papaia', 'price' => 85.00, 'image' => 'https://images.unsplash.com/photo-1619535962037-feb40b6823fd?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=399', 'description' => 'Mamão fresco e doce.', 'category' => 'Frutas Tropicais'],
        ];


        foreach ($fruits as $fruit) {
            DB::table('fruits')->insert(array_merge($fruit, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
