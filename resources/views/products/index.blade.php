<x-app-layout>
<div class="container mx-auto p-6">
<div class="p-6" x-data="{ 
    addProduct: false, 
    editProduct: false, 
    selectedProduct: {} 
}">

    <div class="flex justify-between mb-4">
        <h1 class="text-2xl font-bold">Products</h1>

        <!-- OPEN ADD MODAL -->
        <button
            @click="addProduct = true"
            class="bg-green-600 text-white px-4 py-2 rounded">
            Add Product
        </button>
    </div>

    <!-- PRODUCT TABLE -->
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Name</th>
                <th class="p-2 text-left">Price</th>
                <th class="p-2 text-left">Stock</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>

        <tbody>
        @foreach($products as $product)
            <tr class="border-b">
                <td class="p-2">{{ $product->name }}</td>
                <td class="p-2">₱{{ $product->price }}</td>
                <td class="p-2">{{ $product->stock }}</td>
                <td class="p-2">
                    <!-- OPEN EDIT MODAL -->
                    <button 
                        @click="editProduct = true; selectedProduct = {{ $product->toJson() }}"
                        class="text-blue-600">
                        Edit
                    </button>

                    <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                        @csrf @method('DELETE')
                        <button class="text-red-600 ml-2">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- ADD PRODUCT MODAL -->
    <div
        x-show="addProduct"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded shadow-lg w-96" @click.outside="addProduct = false">

            <h2 class="text-xl font-bold mb-4">Add Product</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Name:</label>
                <input type="text" name="name" class="w-full border p-2 mb-3 rounded">

                <label>Description:</label>
                <textarea name="description" class="w-full border p-2 mb-3 rounded"></textarea>

                <label>Price (₱):</label>
                <input type="number" step="0.01" name="price" class="w-full border p-2 mb-3 rounded">

                <label>Stock:</label>
                <input type="number" name="stock" class="w-full border p-2 mb-3 rounded">

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" @click="addProduct = false" class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Save Product
                    </button>
                </div>
            </form>

        </div>
    </div>
    <!-- END ADD MODAL -->

    <!-- EDIT PRODUCT MODAL -->
    <div
        x-show="editProduct"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50">

        <div class="bg-white p-6 rounded shadow-lg w-96"
             @click.outside="editProduct = false">

            <h2 class="text-xl font-bold mb-4">Edit Product</h2>

            <form
                :action="'/products/' + selectedProduct.id"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <label>Name:</label>
                <input
                    type="text"
                    name="name"
                    class="w-full border p-2 mb-3 rounded"
                    x-model="selectedProduct.name">

                <label>Description:</label>
                <textarea
                    name="description"
                    class="w-full border p-2 mb-3 rounded"
                    x-model="selectedProduct.description">
                </textarea>

                <label>Price (₱):</label>
                <input
                    type="number"
                    step="0.01"
                    name="price"
                    class="w-full border p-2 mb-3 rounded"
                    x-model="selectedProduct.price">

                <label>Stock:</label>
                <input
                    type="number"
                    name="stock"
                    class="w-full border p-2 mb-3 rounded"
                    x-model="selectedProduct.stock">

                {{-- <label>Image:</label>
                <input type="file" name="image" class="mb-3"> --}}

                <template x-if="selectedProduct.image">
                    <img :src="'/storage/' + selectedProduct.image" class="w-24 mt-2 rounded">
                </template>

                <div class="flex justify-end space-x-2 mt-4">
                    <button type="button" @click="editProduct = false" class="px-4 py-2 border rounded">
                        Cancel
                    </button>

                    <button class="bg-blue-600 text-white px-4 py-2 rounded">
                        Update Product
                    </button>
                </div>
            </form>

        </div>
    </div>
    <!-- END EDIT MODAL -->

</div>
</div>
</x-app-layout>
