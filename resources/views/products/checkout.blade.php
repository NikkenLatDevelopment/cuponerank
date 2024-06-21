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
        background: #f4f4f4;
        color: #333;
        position: relative; /* Asegura que el body tenga posición relativa */
        padding-top: 60px; /* Añade espacio para evitar que el contenido se solape con el botón */
    }
    .container {
        display: flex;
        justify-content: space-between; /* Alinea los elementos a los extremos del contenedor */
        align-items: center; /* Centra los elementos verticalmente */
        width: 80%;
        margin: auto;
        overflow: hidden;
    }
    .header-logo {
        height: 50px; /* Ajusta la altura del logo */
        position: absolute; /* Posicionamiento absoluto dentro del header */
        right: 0; /* Alinea el logo a la derecha */
        top: 10px; /* Posición vertical para centrar el logo */
    }
    .fixed-button {
        position: fixed; /* Fija la posición del elemento respecto a la ventana del navegador */
        top: 20px;       /* Espacio desde el top de la ventana */
        right: 20px;     /* Espacio desde el right de la ventana */
        z-index: 1000;   /* Asegura que el botón se mantenga sobre otros elementos */
        background-color: #3a7ca5; /* Color de fondo azul verdoso */
        color: white;    /* Color del texto */
        border: none;    /* Sin borde */
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px; /* Bordes redondeados */
        cursor: pointer; /* Cambia el cursor a tipo puntero */
    }
        header {
        background: #333;
        color: #fff;
        padding-top: 30px;
        min-height: 70px;
        border-bottom: #0779e4 3px solid;
        position: relative; /* Permite posicionar el logo absolutamente respecto a este bloque */
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
