<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupónmanía Catálogo de Productos</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background: url('{{ asset('images/Fondo01.png') }}') no-repeat center center fixed;
            background-size: cover;
            color: #333333;
            position: relative;
            padding-top: 60px;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        .header-logo {
            height: 50px;
            position: absolute;
            right: 0;
            top: 10px;
        }
        .fixed-button {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background-color: #578e41;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        header {
            background: #578e41;
            color: #ffffff;
            padding-top: 30px;
            min-height: 100px;
            border-bottom: #a2bc3d 3px solid;
            position: relative;
        }
        header a {
            color: #ffffff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
        }
        .user-info {
            text-align: right;
            margin-top: 20px;
            color: #ffffff;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .product {
            background: white;
            margin: 10px;
            box-shadow: 0 0 10px #ccc;
            width: calc(25% - 20px);
            padding: 10px;
            box-sizing: border-box;
        }
        .product img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        h1, h2 {
            font-family: 'Poppins Bold', sans-serif;
        }
        p {
            font-family: 'Poppins Regular', sans-serif;
            font-size: 16px;
            color: #555555;
        }
        @media (max-width: 600px) {
            .product {
                width: calc(50% - 20px);
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>Cupónmanía Catálogo de Productos</h1>
            <img src="https://nikkenlatam.com/site/custom/img/general/logo-nikken.png" alt="Logo de Nikken" class="header-logo">
            <div class="user-info">
                <p><b>Bienvenido {{$nombre_u}}</b></p>
                <p><b>Este cupón se ha redimido {{$redimido}} veces.</b></p>
            </div>
        </div>
    </header>
    <div class="container">
        <form action="{{ url('/checkout') }}" method="POST">
            @csrf
            <div class="products">
                @foreach ($products as $product)
                    <div class="product">
                        <img src="{{ asset('https://storage.googleapis.com/tv-store/Products/images/'.$product->detail_image) }}" alt="Imagen de {{ $product->name }}">
                        <h2>{{ $product->name }}</h2>       
                        <p>Descripción: {{ $product->description ?? 'No disponible' }}</p>
                        @if($tipo_u != 'CLIENTE')
                        <p>Puntos: {{ $product->points ?? '0' }}</p>
                        <p>VC: {{ $product->vc_to_suggested ?? '0' }}</p>
                        @endif                        
                        <p>Precio: {{ $product->suggested_price ?? '0' }} {{ config('app.currency') }}</p>
                        <input type="number" name="quantity[{{ $product->id }}]" min="0" value="0" style="width: 50px;">
                        <label for="quantity-{{ $product->id }}">Cantidad</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="fixed-button">Ir al Checkout</button>
        </form>
    </div>
</body>
</html>
