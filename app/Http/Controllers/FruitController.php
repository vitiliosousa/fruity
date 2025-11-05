<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Inertia\Inertia;

class FruitController extends Controller
{
    public function index()
    {
        $fruits = Fruit::all();
         $fruits = [
            ['id' => 1, 'name' => 'Maçã', 'price' => 1.50],
            ['id' => 2, 'name' => 'Banana', 'price' => 0.80],
            ['id' => 3, 'name' => 'Laranja', 'price' => 1.20],
        ];
        
        return Inertia::render('Fruits/Index', [
            'fruits' => $fruits
        ]);
    }
}
