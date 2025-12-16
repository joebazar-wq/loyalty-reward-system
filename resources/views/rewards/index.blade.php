<x-app-layout>

<div class="container mx-auto p-6">

    <div class="bg-white shadow rounded p-4 mb-6">
        <p class="text-lg">
            Current Points:
            <span class="font-bold">{{ $points }}</span>
        </p>
    </div>

    <h2 class="text-xl font-semibold mb-2">Available Rewards</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        @foreach($rewards as $reward)
        <div class="bg-white shadow rounded p-4">
            <h2 class="font-bold">{{ $reward->name }}</h2>

            {{-- <p class="text-sm mb-2">{{ $reward->description }}</p> --}}

            <p class="mb-2">
                Points Required:
                <span class="font-semibold">{{ $reward->points_required }}</span>
            </p>

            @if($points >= $reward->points_required)
                <form action="{{ route('rewards.redeem.submit', $reward) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">
                        Redeem
                    </button>
                </form>
            @else
                <button class="bg-gray-400 text-white px-4 py-2 rounded" disabled>
                    Not Enough Points
                </button>
            @endif

        </div>
        @endforeach

    </div>

    {{-- <h2 class="text-xl font-semibold mt-8 mb-2">Points History</h2>

    <table class="w-full bg-white shadow rounded">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Type</th>
                <th class="p-2 text-left">Points</th>
                <th class="p-2 text-left">Description</th>
                <th class="p-2 text-left">Date</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transactions as $t)
            <tr class="border-b">
                <td class="p-2">{{ ucfirst($t->type) }}</td>

                <td class="p-2 {{ $t->type === 'redeem' ? 'text-red-600' : 'text-green-600' }}">
                    {{ $t->type === 'redeem' ? '-' : '+' }}{{ $t->points }}
                </td>

                <td class="p-2">{{ $t->description }}</td>

                <td class="p-2">{{ $t->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="p-2 text-center text-gray-500">
                    No points history found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table> --}}

</div>

</x-app-layout>
