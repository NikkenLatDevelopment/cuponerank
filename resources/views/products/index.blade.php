<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Productos</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding-top: 30px;
            min-height: 70px;
            border-bottom: #0779e4 3px solid;
        }
        header a {
            color: #fff;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 16px;
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
        h2 {
            font-size: 18px;
            margin: 5px 0;
        }
        p {
            font-size: 16px;
            color: #555;
        }
        @media (max-width: 600px) {
            .product {
                width: calc(50% - 20px);
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <h1>Catálogo de Productos</h1>
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
                        <p>{{ $product->description }}</p>
                        <input type="number" name="quantity[{{ $product->id }}]" min="0" value="0" style="width: 50px;">
                        <label for="quantity-{{ $product->id }}">Cantidad</label>
                    </div>
                @endforeach
            </div>
            <button type="submit" style="margin: 20px; padding: 10px 20px; font-size: 16px;">Ir al Checkout</button>
        </form>
    </div>
</body>
</html>
