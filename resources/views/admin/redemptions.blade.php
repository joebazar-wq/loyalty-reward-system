@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Manage Redemptions</h1>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">User</th>
                <th class="p-2 text-left">Reward</th>
                <th class="p-2 text-left">Points Used</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($redemptions as $r)
            <tr class="border-b">
                <td class="p-2">{{ $r->user->name }}</td>
                <td class="p-2">{{ $r->reward->name }}</td>
                <td class="p-2">{{ $r->reward->points_required }}</td>
                <td class="p-2">{{ ucfirst($r->status) }}</td>
                <td class="p-2 flex gap-2">
                    @if($r->status === 'pending')
                        <form action="{{ route('redemptions.approve', $r) }}" method="POST">
                            @csrf
                            <button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Approve</button>
                        </form>
                        <form action="{{ route('redemptions.reject', $r) }}" method="POST">
                            @csrf
                            <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Reject</button>
                        </form>
                    @else
                        <span class="text-gray-500">No actions</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
