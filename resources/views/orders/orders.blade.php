<x-app-layout>
<h1 class="text-2xl font-bold mb-4">Manage Orders</h1>

@if(session('success'))
<div class="bg-green-200 text-green-800 px-4 py-2 mb-4 rounded">{{ session('success') }}</div>
@endif

<table class="min-w-full border border-gray-300">
<thead class="bg-gray-100">
<tr>
<th class="px-4 py-2 border">Order ID</th>
<th class="px-4 py-2 border">Customer</th>
<th class="px-4 py-2 border">Item</th>
<th class="px-4 py-2 border">Qty</th>
<th class="px-4 py-2 border">Price</th>
<th class="px-4 py-2 border">Status</th>
<th class="px-4 py-2 border">Action</th>
</tr>
</thead>
<tbody>
@foreach($orders as $order)
<tr>
<td class="px-4 py-2 border">{{ $order->id }}</td>
<td class="px-4 py-2 border">{{ $order->customer->name }}</td>
<td class="px-4 py-2 border">{{ $order->item_name }}</td>
<td class="px-4 py-2 border">{{ $order->quantity }}</td>
<td class="px-4 py-2 border">₱{{ number_format($order->price,2) }}</td>
<td class="px-4 py-2 border">{{ ucfirst($order->status) }}</td>
<td class="px-4 py-2 border">
<form action="{{ route('orders.updateStatus', $order) }}" method="POST">
    @csrf
    <select name="status" onchange="this.form.submit()" class="border rounded px-2 py-1">
        <option value="pending"   {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved"  {{ $order->status === 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="declined"  {{ $order->status === 'declined' ? 'selected' : '' }}>Declined</option>
        <option value="canceled"  {{ $order->status === 'canceled' ? 'selected' : '' }}>Canceled</option>
    </select>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>

</x-app-layout>
