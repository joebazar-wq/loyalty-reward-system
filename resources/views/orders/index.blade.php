<x-app-layout>
<h1 class="text-2xl font-bold mb-4">Orders</h1>

@if(session('success'))
<div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">{{ session('success') }}</div>
@endif

<table class="min-w-full border border-gray-300">
<thead class="bg-gray-100">
<tr>
    <th class="px-4 py-2 border">Order ID</th>
    <th class="px-4 py-2 border">Item</th>
    <th class="px-4 py-2 border">Qty</th>
    <th class="px-4 py-2 border">Price</th>
    <th class="px-4 py-2 border">Payment Method</th>
    <th class="px-4 py-2 border">Status</th>
</tr>
</thead>

<tbody>
@forelse($orders as $order)
<tr>
    <td class="px-4 py-2 border">{{ $order->id }}</td>
    <td class="px-4 py-2 border">{{ $order->item_name }}</td>
    <td class="px-4 py-2 border">{{ $order->quantity }}</td>
    <td class="px-4 py-2 border">₱{{ number_format($order->price, 2) }}</td>
    <td class="px-4 py-2 border">{{ $order->payment_method ?? '-' }}</td>
    <td class="px-4 py-2 border">
        <span class="px-2 py-1 rounded
            @if($order->status === 'pending') bg-yellow-200 text-yellow-800
            @elseif($order->status === 'approved') bg-green-200 text-green-800
            @elseif($order->status === 'declined') bg-red-200 text-red-800
            @elseif($order->status === 'canceled') bg-gray-200 text-gray-800
            @endif">
            {{ ucfirst($order->status) }}
        </span>
    </td>
</tr>
{{-- @empty --}}
{{-- <tr>
    <td colspan="6" class="px-4 py-2 border text-center text-gray-500">
        No orders yet.
    </td>
</tr> --}}
@endforelse
</tbody>
</table>

</x-app-layout>
