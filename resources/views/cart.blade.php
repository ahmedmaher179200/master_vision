<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="{{ asset('theme/site/main_css2.css')}}">
</head>
<body>

    <header>
        <h1>Shopping Cart</h1>
    </header>

    <div class="cart-container">
        <form action="{{route('checkout')}}" method="post">
            @csrf
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cart_items as $key => $item)
                        @php
                            $product = App\Models\Product::findOrFail($item['product_id']);
                        @endphp
                        <tr>
                            <input type="hidden" name="products[{{$key}}][product_id]" value="{{$product->id}}">
                            <input type="hidden" name="products[{{$key}}][quantity]" value="{{$item['quantity']}}">
                            <td>{{$product->name}}</td>
                            <td>${{$product->price}}</td>
                            <td>{{$item['quantity']}}</td>
                            <td>${{$product->price * $item['quantity']}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="checkout-btn">Proceed to Checkout</a>
        </form>
    </div>

</body>
</html>