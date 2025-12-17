<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Manage Redemptions
            </h2>

            <button
                onclick="openCreateRewardModal()"
                class="px-4 py-2 bg-green-600 text-white rounded-lg text-sm font-semibold hover:bg-green-700">
                + Add Reward
            </button>
        </div>

        <div class="bg-neutral-50 shadow-md rounded-lg p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Description
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Points Required
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Status
                            </th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($rewards as $reward)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $reward->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $reward->description }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $reward->points_required }}
                            </td>

                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full
                                    {{ $reward->status === 'active' ? 'bg-green-100 text-green-800' :
                                       'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($reward->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right text-sm space-x-3">
                                <button
                                    onclick="openEditRewardModal({{ $reward->id }})"
                                    class="text-blue-600 hover:text-blue-900 font-semibold">
                                    Edit
                                </button>

                                <form action="{{ route('admin.rewards.destroy', $reward) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this reward?')"
                                        class="text-red-600 hover:text-red-900 font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                                No rewards found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>

{{-- Edit Reward Modals --}}
@foreach($rewards as $reward)
<div id="editRewardModal-{{ $reward->id }}"
     class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-xl shadow-xl overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Edit Reward</h2>
            <button onclick="closeEditRewardModal({{ $reward->id }})"
                    class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.rewards.update', $reward) }}" class="px-6 py-5 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ $reward->name }}" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" required
                          class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">{{ $reward->description }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Points Required</label>
                <input type="number" name="points_required" value="{{ $reward->points_required }}" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    <option value="active" @selected($reward->status === 'active')>Active</option>
                    <option value="inactive" @selected($reward->status === 'inactive')>Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button"
                        onclick="closeEditRewardModal({{ $reward->id }})"
                        class="px-4 py-2 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">Cancel</button>

                <button type="submit"
                        class="px-5 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Create Reward Modal --}}
<div id="createRewardModal"
     class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white w-full max-w-lg rounded-xl shadow-xl overflow-hidden">
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">Add New Reward</h2>
            <button onclick="closeCreateRewardModal()" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
        </div>

        <form method="POST" action="{{ route('admin.rewards.store') }}" class="px-6 py-5 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" required
                          class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Points Required</label>
                <input type="number" name="points_required" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name="status"
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-green-500">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button"
                        onclick="closeCreateRewardModal()"
                        class="px-4 py-2 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">
                    Cancel
                </button>

                <button type="submit"
                        class="px-5 py-2 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">
                    Create Reward
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Modals JS --}}
<script>
function openCreateRewardModal() { document.getElementById('createRewardModal').classList.remove('hidden'); }
function closeCreateRewardModal() { document.getElementById('createRewardModal').classList.add('hidden'); }

@foreach($rewards as $reward)
function openEditRewardModal(id) { document.getElementById('editRewardModal-' + id).classList.remove('hidden'); }
function closeEditRewardModal(id) { document.getElementById('editRewardModal-' + id).classList.add('hidden'); }
@endforeach
</script>
