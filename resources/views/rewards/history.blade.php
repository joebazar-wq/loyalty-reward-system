<x-app-layout>

<div class="max-w-6xl mx-auto p-6">

    <h2 class="text-2xl font-bold mb-4">Points Transaction History</h2>

    <div class="bg-white shadow rounded p-4 overflow-x-auto">

        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Type</th>
                    <th class="px-4 py-2 text-left">Points</th>
                    <th class="px-4 py-2 text-left">Description</th>
                    <th class="px-4 py-2 text-left">Date</th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200">

                @forelse ($transactions as $t)
                <tr>
                    <td class="px-4 py-2">{{ ucfirst($t->type) }}</td>

                    <td class="px-4 py-2 {{ $t->type === 'redeem' ? 'text-red-600' : 'text-green-600' }}">
                        {{ $t->type === 'redeem' ? '-' : '+' }}{{ $t->points }}
                    </td>

                    <td class="px-4 py-2">{{ $t->description }}</td>

                    <td class="px-4 py-2">{{ $t->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @empty

                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">
                        No point transactions found.
                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>

    </div>

</div>

</x-app-layout>
