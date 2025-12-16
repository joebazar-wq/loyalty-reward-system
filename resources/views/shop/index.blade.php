<x-app-layout>
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Shop</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="bg-white shadow p-4 rounded">
                <h3 class="font-bold text-xl text-center">{{ $product->name }}</h3>
                <p class="text-md mb-2 mt-2 text-right">Stock: {{ $product->stock }}</p>
                <p class="font-semibold mb-2 text-right">₱{{ number_format($product->price, 2) }}</p>

                <form action="{{ route('shop.order', $product) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_name" value="{{ $product->name }}">
                    <input type="hidden" name="price" value="{{ $product->price }}">
                    <label for="">Payment Method</label>
                    <select name="payment_method" class="border rounded p-1 w-full mb-2 mt-2">
                        <option value="cod">Cash On Delivery</option>
                        {{-- <option value="credit_card">Credit Card</option> --}}
                    </select>
                    <label for="">QTY</label>
                    <input type="number" name="quantity" value="1" min="1" class="border rounded p-1 w-20 mb-2 mt-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded w-full">Order</button>
                </form>
            </div>
        @endforeach
    </div>

</div>
</x-app-layout>
