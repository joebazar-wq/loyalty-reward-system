<x-app-layout>
    <div class="max-w-7xl mx-auto mt-10 space-y-6 px-4 sm:px-6 lg:px-8">

        <!-- Welcome Card -->
        <div class="bg-neutral-50 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-700">Hi {{ auth()->user()->name }},</h1>
            <p class="mt-2 text-gray-600 dark:text-gray-700">
                Welcome to your dashboard! You are logged in as <b>{{ auth()->user()->role }}</b>.
            </p>
        </div>

        <!-- Points Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-neutral-50 shadow-md rounded-lg p-6 flex flex-col justify-between h-40">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-700">Total Points Earned</p>
                <p class="text-2xl font-bold text-right text-gray-900 dark:text-gray-700">{{ $totalEarned }}</p>
            </div>

            <div class="bg-neutral-50 shadow-md rounded-lg p-6 flex flex-col justify-between h-40">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-700">Total Points Redeemed</p>
                <p class="text-2xl font-bold text-right text-gray-900 dark:text-gray-700">{{ $totalRedeemed }}</p>
            </div>

            <div class="bg-neutral-50 shadow-md rounded-lg p-6 flex flex-col justify-between h-40">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-700">Remaining Points Balance</p>
                <p class="text-2xl font-bold text-right text-gray-900 dark:text-gray-700">{{ $remainingBalances }}</p>
            </div>

            <div class="bg-neutral-50 shadow-md rounded-lg p-6 flex flex-col justify-between h-40">
                <p class="text-lg font-semibold text-gray-700 dark:text-gray-700">Your Role</p>
                <p class="text-2xl font-bold text-right text-gray-900 dark:text-gray-700">{{ auth()->user()->role }}</p>
            </div>

        </div>

        <!-- Purchase History Table -->
        <div class="bg-neutral-50 shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-700 mb-4">Purchase History</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-700 uppercase tracking-wider">
                                Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-700 uppercase tracking-wider">
                                Item
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-700 uppercase tracking-wider">
                                Points Used
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-700 uppercase tracking-wider">
                                Status
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-700">
                                {{ $transaction->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-700">
                                {{ $transaction->item_name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-700">
                                {{ $transaction->points }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $transaction->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $transaction->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500 dark:text-gray-400">
                                No purchase history found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>
