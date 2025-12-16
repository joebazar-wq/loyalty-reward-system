<x-app-layout>
<div class="max-w-7xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Rewards</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-semibold text-white">{{ $reward->name }}</h2>
        <p class="text-white">{{ $reward->description }}</p>
        <p class="text-white">Points Required: {{ $reward->points_required }}</p>

        @if($account && $remainingPoints >= $reward->points_required)
            <form action="{{ route('rewards.redeem', $reward->id) }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded mt-4">Redeem</button>
            </form>
        @else
            <p class="text-red-500 mt-4">You do not have enough points to redeem this reward.</p>
        @endif
    </div>
</div>
</x-app-layout>
