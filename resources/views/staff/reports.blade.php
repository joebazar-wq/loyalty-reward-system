<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Admin Reports
        </h2>
    </x-slot>

    <div class="p-6 space-y-4">
        <div class="bg-white p-4 rounded shadow">
            <strong>Total Points Earned:</strong> {{ $totalEarned }}
        </div>

        <div class="bg-white p-4 rounded shadow">
            <strong>Total Points Redeemed:</strong> {{ $totalRedeemed }}
        </div>

        <div class="bg-white p-4 rounded shadow">
            <strong>Remaining Points Balance:</strong> {{ $remainingBalances }}
        </div>
    </div>
</x-app-layout>
