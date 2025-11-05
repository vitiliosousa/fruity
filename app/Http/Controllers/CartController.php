<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Resend;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        
        return Inertia::render('Cart/Index', [
            'cart' => $cart,
            'user' => $request->user()
        ]);
    }

    public function add(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        
        $itemExists = false;
        foreach ($cart as &$cartItem) {
            if ($cartItem['id'] == $request->id) {
                $cartItem['quantity']++;
                $itemExists = true;
                break;
            }
        }
        
        if (!$itemExists) {
            $item = [
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'image'=> $request->image,
                'quantity' => $request->quantity ?? 1,
            ];
            $cart[] = $item;
        }
        
        $request->session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item adicionado ao carrinho!');
    }

    public function remove(Request $request, $index)
    {
        $cart = $request->session()->get('cart', []);
        
        if (isset($cart[$index])) {
            unset($cart[$index]);
            $cart = array_values($cart);
            $request->session()->put('cart', $cart);
            
            return redirect()->back()->with('success', 'Item removido do carrinho!');
        }
        
        return redirect()->back()->with('error', 'Item não encontrado!');
    }


    public function update(Request $request)
{
    $cart = session()->get('cart', []);

    $index = $request->index;
    $quantity = $request->quantity;

    // Se o item não existe no carrinho
    if (!isset($cart[$index])) {
        return redirect()->back()->with('error', 'Item não encontrado no carrinho.');
    }

    // Se quantidade <= 0, remove o item
    if ($quantity <= 0) {
        unset($cart[$index]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item removido do carrinho.');
    }

    // Atualiza quantidade
    $cart[$index]['quantity'] = $quantity;

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Quantidade atualizada com sucesso!');
}


    public function checkout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Seu carrinho está vazio!');
        }

        // Calcula o total
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Prepara os dados do pedido
        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $customerName = $request->user()->name;
        $customerEmail = $request->user()->email;
        $orderDate = now()->format('d/m/Y H:i:s');

        // Monta o HTML do email
        $emailHtml = view('emails.order-confirmation', [
            'order' => [
                'order_number' => $orderNumber,
                'customer_name' => $customerName,
                'customer_email' => $customerEmail,
                'items' => $cart,
                'date' => $orderDate,
            ],
            'total' => $total
        ])->render();

        // Envia o email via Resend
        try {
            \Log::info('Tentando enviar email para: ' . $customerEmail);
            
            $resend = Resend::client(config('services.resend.key'));
            
            $result = $resend->emails->send([
                'from' => 'Fruity <onboarding@resend.dev>',
                'to' => [$customerEmail],
                'subject' => 'Confirmação de Pedido #' . $orderNumber,
                'html' => $emailHtml,
            ]);
            
            \Log::info('Email enviado com sucesso! ID: ' . json_encode($result));
            
            // Limpa o carrinho após pagamento bem-sucedido
            $request->session()->forget('cart');
            
            return redirect()->route('cart.index')->with('success', 'Pagamento realizado com sucesso! Verifique seu email para o resumo da compra.');
        } catch (\Exception $e) {
            \Log::error('Erro ao enviar email: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            
            return redirect()->back()->with('error', 'Erro ao processar pagamento: ' . $e->getMessage());
        }
    }
}