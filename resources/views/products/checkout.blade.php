<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
            color: #333;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            max-width: 1200px;
        }
        header {
            background: #343a40;
            color: #fff;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 24px;
            font-weight: bold;
        }
        .products-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        .products-header h2 {
            font-size: 24px;
            margin: 0;
            color: #007bff;
        }
        .products-header span {
            font-size: 18px;
            color: #666;
        }
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }
        .product {
            background: white;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .product:hover {
            transform: scale(1.05);
        }
        .product img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px 8px 0 0;
        }
        .product h2 {
            font-size: 20px;
            margin: 10px 0;
            color: #007bff;
        }
        .product p {
            font-size: 14px;
            color: #666;
        }
        .product .quantity {
            font-size: 16px;
            color: #333;
            margin-top: 10px;
        }
        .product button {
            background: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .product button:hover {
            background: #0056b3;
        }
        .checkout-button {
            display: block;
            width: 100%;
            background: #28a745;
            color: #fff;
            border: none;
            padding: 15px;
            font-size: 18px;
            text-align: center;
            text-transform: uppercase;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            margin-top: 20px;
        }
        .checkout-button:hover {
            background: #218838;
        }
        .no-products {
            text-align: center;
            font-size: 18px;
            color: #666;
            margin: 50px 0;
        }
    </style>
</head>
<body>
    <header>
        <a href="#">Cuponera</a>
    </header>
    <div class="container">
        <h1>Checkout</h1>
        @if(count($products) > 0)
            <!--
            <div class="products-header">
                <h2>Productos Seleccionados</h2>
                <span>{{ count($products) }} producto(s) seleccionado(s)</span>
            </div>
    -->
            <div class="products">
                @foreach($products as $product)
                    <div class="product">
                        <img src="{{ $product->detail_image ? asset('https://storage.googleapis.com/tv-store/Products/images/'.$product->detail_image) : asset('path/to/default-image.jpg') }}" alt="Imagen de {{ $product->name }}">
                        <h2>{{ $product->name }}</h2>
                        <p>{{ $product->description }}</p>
                        <p class="quantity">Cantidad: {{ $product->quantity }}</p>
                        <!-- Botón de acción para cada producto -->
                    </div>
                @endforeach
            </div>
            <form action="{{ url('/getCheckout') }}" method="POST">
                @csrf
                <button type="submit" class="checkout-button">Confirmar Pedido</button>
            </form>
        @else
            <p class="no-products">No hay productos seleccionados.</p>
        @endif
    </div>
</body>
</html>
