<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Aquí iría el CSS como en el ejemplo anterior -->
</head>
<body>
    <div class="container">
        <h1>Checkout</h1>
        @if(count($products) > 0)
            <ul>
                @foreach($products as $product)
                <div class="product">
        <img src="{{ $product->detail_image ? asset('https://storage.googleapis.com/tv-store/Products/images/'.$product->detail_image) : asset('path/to/default-image.jpg') }}" alt="Imagen de {{ $product->name }}">
       
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <!-- Más detalles del producto aquí -->
    </div>
                @endforeach
            </ul>
            <form action="{{ url('/getCheckout') }}" method="POST">
                @csrf
                <button type="submit" style="padding: 10px 20px; font-size: 16px;">Confirmar Pedido</button>
            </form>
        @else
            <p>No hay productos seleccionados.</p>
        @endif
    </div>
</body>
</html>
