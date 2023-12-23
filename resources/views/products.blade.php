<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Product Page</title>
    <link rel="stylesheet" href="{{ asset('theme/site/main_css.css')}}">

</head>
<body>
    <header>
        <h1>Product Page</h1>
        <div class="card">
            <a href="{{route('cart')}}"><img src="{{ asset('cart.png')}}" style="width: 70px;"></a>
            <a href="{{route('cart')}}" style="color:white"><span class="count">
                @if (session('cart'))
                    {{count(session('cart'))}}
                @else
                    0
                @endif
            </span></a>
        </div>
        
    </header>

    <section class="products">
        @foreach ($products as $product)
            <div class="product">
                <img src="{{$product->getImage()}}" alt="Product 1">
                <div class="product-details">
                    <h2>{{$product->name}}</h2>
                    <p>{{$product->description}}</p>
                    <p class="price">${{$product->price}}</p>
                    <button class="add-to-cart" data-productId="{{$product->id}}">Add to Cart</button>
                </div>
            </div>
        @endforeach
        <!-- Add more product entries as needed -->
    </section>
    <script
    src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
    crossorigin="anonymous"></script>
</body>
</html>

<script>
    $(document).on("click",".add-to-cart", function(){
        var product_id = $(this).attr("data-productId");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $.ajax({
            async: false,
            method: "post",
            url: "{{route('addProductToCartAjax')}}",
            data: {
                product_id: product_id,
        },
        
        success: function (data) {
            $('.count').html(data);
        },
        error: function (data) {
            alert('false');
        }
        });
    })
</script>
