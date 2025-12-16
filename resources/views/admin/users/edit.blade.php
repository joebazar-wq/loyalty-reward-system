<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white shadow rounded-lg p-6">

        <h2 class="text-xl font-bold mb-6">Edit User Role</h2>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Role
                </label>
                <select name="role"
                        class="w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="user"  @selected($user->role === 'user')>User</option>
                    <option value="staff" @selected($user->role === 'staff')>Staff</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 text-sm rounded-md bg-gray-200 hover:bg-gray-300">
                    Cancel
                </a>

                <button class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-md hover:bg-indigo-700">
                    Save
                </button>
            </div>
        </form>

    </div>
</x-app-layout>
