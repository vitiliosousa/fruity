<?php

namespace App\Http\Controllers;

use App\Models\Fruit;
use Inertia\Inertia;

class FruitController extends Controller
{
    public function index()
    {
        $fruits = [
            ['id' => 1, 'name' => 'Maçã', 'price' => 75.00],
            ['id' => 2, 'name' => 'Banana', 'price' => 40.00],
            ['id' => 3, 'name' => 'Laranja', 'price' => 60.00],
        ];
        
        return Inertia::render('Fruits/Index', [
            'fruits' => $fruits
        ]);
    }
}