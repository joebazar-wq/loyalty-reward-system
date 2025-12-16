<x-app-layout>
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>

    <div class="bg-white shadow rounded p-4 mb-6">
        <p class="text-lg">Current Points: <span class="font-bold">{{ $points }}</span></p>
    </div>

    <h2 class="text-xl font-semibold mb-2">Available Rewards</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($rewards as $reward)
            <div class="bg-white shadow rounded p-4 flex flex-col justify-between">
                <h3 class="font-bold text-white">{{ $reward->name }}</h3>
                <p class="text-sm mb-2 text-white">{{ $reward->description }}</p>
                <p class="mb-2 text-white">Points Required: <span class="font-semibold">{{ $reward->points_required }}</span></p>
                @if($points >= $reward->points_required)
                    <form action="{{ route('rewards.redeem.submit', $reward) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white rounded px-3 py-2">
                            Redeem
                        </button>
                    </form>
                @else
                    <button class="bg-gray-400 text-white rounded px-3 py-2 cursor-not-allowed" disabled>
                        Not Enough Points
                    </button>
                @endif
            </div>
        @endforeach
    </div>

    {{-- <h2 class="text-xl font-semibold mt-8 mb-2">Redemption History</h2>
    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Reward</th>
                <th class="p-2 text-left">Points Used</th>
                <th class="p-2 text-left">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($redemptions as $r)
            <tr class="border-b">
                <td class="p-2">{{ $r->description }}</td>
                <td class="p-2">{{ $r->points }}</td>
                <td class="p-2">{{ $r->created_at->format('Y-m-d') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}

</div>
</x-app-layout>
