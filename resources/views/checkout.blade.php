<x-app-layout>
    <h1 class="text-2xl font-bold mb-4">Checkout</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('orders.place') }}" method="POST" class="bg-white p-6 rounded shadow w-full md:w-1/2">
        @csrf

        <div class="mb-4">
            <label class="block font-semibold mb-1">Item Name</label>
            <input type="text" name="item_name" required class="w-full border p-2 rounded" />
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Quantity</label>
            <input type="number" name="quantity" min="1" value="1" required class="w-full border p-2 rounded" />
        </div>

        <div class="mb-4">
            <label class="block font-semibold mb-1">Price (₱)</label>
            <input type="number" name="price" min="1" required class="w-full border p-2 rounded" />
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Place Order
        </button>
    </form>

</x-app-layout>
