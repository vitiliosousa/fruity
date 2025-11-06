<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Fruit;
use Illuminate\Http\Request;

class FruitController extends Controller
{
    public function index(Request $request)
    {
        // Busca todas as frutas do banco, ordenadas pelo mais recente
        $fruits = Fruit::orderBy('created_at', 'desc')->get();

        // Recupera o carrinho da sessão
        $cart = $request->session()->get('cart', []);
        $cartCount = array_sum(array_column($cart, 'quantity'));

        // Retorna os dados para a view Inertia
        return Inertia::render('Fruits/Index', [
            'fruits' => $fruits,
            'cartCount' => $cartCount,
        ]);
    }
}
