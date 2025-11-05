<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #10b981;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9fafb;
            padding: 20px;
            border: 1px solid #e5e7eb;
        }
        .order-item {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            border-left: 4px solid #10b981;
            border-radius: 4px;
        }
        .total {
            background-color: #10b981;
            color: white;
            padding: 15px;
            text-align: right;
            font-size: 1.2em;
            font-weight: bold;
            border-radius: 4px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6b7280;
            font-size: 0.9em;
        }
        .info-box {
            background-color: #e0f2fe;
            border-left: 4px solid #0284c7;
            padding: 15px;
            margin: 15px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🍎 Confirmação de Pedido</h1>
    </div>
    
    <div class="content">
        <h2>Olá, {{ $order['customer_name'] }}!</h2>
        <p>Obrigado pela sua compra! Aqui está o resumo do seu pedido:</p>
        
        <div class="info-box">
            <strong>Data do Pedido:</strong> {{ $order['date'] }}<br>
            <strong>Número do Pedido:</strong> #{{ $order['order_number'] }}
        </div>
        
        <h3>Itens do Pedido:</h3>
        @foreach($order['items'] as $item)
        <div class="order-item">
            <strong>{{ $item['name'] }}</strong><br>
            Quantidade: {{ $item['quantity'] }}<br>
            Preço unitário: {{ number_format($item['price'], 2, ',', '.') }} MT<br>
            Subtotal: <strong>{{ number_format($item['price'] * $item['quantity'], 2, ',', '.') }} MT</strong>
        </div>
        @endforeach
        
        <div class="total">
            Total do Pedido: {{ number_format($total, 2, ',', '.') }} MT
        </div>
    </div>
    
    <div class="footer">
        <p>Este é um email automático, por favor não responda.</p>
        <p>&copy; 2025 Fruity. Todos os direitos reservados.</p>
    </div>
</body>
</html>