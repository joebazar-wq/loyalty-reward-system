<x-app-layout>
<div class="container mx-auto p-6">
<h1 class="text-2xl font-bold mb-4">Orders</h1>
{{-- {{ dd($orders) }} --}}
@if(session('success'))
<div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">
    {{ session('success') }}
</div>
@endif

<table class="min-w-full border border-gray-300">
<thead class="bg-gray-100">
<tr>
    <th class="px-4 py-2 border">Item</th>
    <th class="px-4 py-2 border">Qty</th>
    <th class="px-4 py-2 border">Price</th>
    <th class="px-4 py-2 border">Total</th>
    <th class="px-4 py-2 border">Status</th>
    <th class="px-4 py-2 border">Payment</th>

    @if(auth()->user()->role === 'admin')
        <th class="px-4 py-2 border">Actions</th>
    @endif
</tr>
</thead>

<tbody>
@forelse($orders as $order)
<tr>
    <td class="px-4 py-2 border">{{ $order->item_name }}</td>
    <td class="px-4 py-2 border">{{ $order->quantity }}</td>
    <td class="px-4 py-2 border">₱{{ number_format($order->price, 2) }}</td>
    <td class="px-4 py-2 border">₱{{ number_format($order->total_amount, 2) }}</td>

    {{-- STATUS --}}
    <td class="px-4 py-2 border">
        <span class="px-2 py-1 rounded
            @if($order->status === 'pending') bg-yellow-200 text-yellow-800
            @elseif($order->status === 'processing') bg-blue-200 text-blue-800
            @elseif($order->status === 'completed') bg-green-200 text-green-800
            @else bg-gray-200 text-gray-800
            @endif">
            {{ ucfirst($order->status) }}
        </span>
    </td>

    {{-- PAYMENT --}}
    <td class="px-4 py-2 border">
        {{ strtoupper($order->payment_method ?? 'N/A') }}
    </td>

    {{-- ADMIN ACTION --}}
    @if(auth()->user()->role === 'admin')
    <td class="px-4 py-2 border">
        <form action="{{ route('orders.updateStatus', $order) }}" method="POST">
            @csrf
            <select name="status" class="border rounded px-2 py-1">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="canceled" {{ $order->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
            </select>
            <button class="ml-2 px-3 py-1 bg-blue-600 text-white rounded">
                Update
            </button>
        </form>
    </td>
    @endif
</tr>
@empty
<tr>
    <td colspan="{{ auth()->user()->role === 'admin' ? 7 : 6 }}"
        class="px-4 py-2 border text-center text-gray-500">
        No orders yet.
    </td>
</tr>
@endforelse
</tbody>
</table>
</div>
</x-app-layout>
