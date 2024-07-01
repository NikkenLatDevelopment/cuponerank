<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/Fondo01.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #333333;
        }
        .container {
            width: 90%;
            margin: auto;
            padding: 20px;
            max-width: 1200px;
        }
        header {
            background: #578e41;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            position: relative;
        }
        header a {
            color: #ffffff;
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
            color: #578e41;
        }
        .products-header span {
            font-size: 18px;
            color: #666666;
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
            color: #578e41;
        }
        .product p {
            font-size: 14px;
            color: #666666;
        }
        .product .quantity {
            font-size: 16px;
            color: #333333;
            margin-top: 10px;
        }
        .product button {
            background: #578e41;
            color: #ffffff;
            border: none;
            padding: 10px 15px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .product button:hover {
            background: #4a7a36;
        }
        .checkout-button {
            display: block;
            width: 100%;
            background: #a2bc3d;
            color: #ffffff;
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
            background: #8fa431;
        }
        .no-products {
            text-align: center;
            font-size: 18px;
            color: #666666;
            margin: 50px 0;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">
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
