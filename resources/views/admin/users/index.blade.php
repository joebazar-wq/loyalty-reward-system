<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-10">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">
            Manage Users
        </h2>

        <button
            onclick="openCreateModal()"
            class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700">
            + Add User
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
                                Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Role
                            </th>
                            {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">
                                Role
                            </th> --}}
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $user->name }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-900">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="px-2 inline-flex text-xs font-semibold rounded-full
                                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' :
                                       ($user->role === 'staff' ? 'bg-blue-100 text-blue-800' :
                                       'bg-green-100 text-green-800') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right text-sm space-x-3">
                                {{-- <a href="{{ route('admin.users.edit', $user) }}"
                                   class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                    Edit
                                </a> --}}
                            <button
                                onclick="openModal({{ $user->id }})"
                                class="text-indigo-600 hover:text-indigo-900 font-semibold">
                                Edit
                            </button>


                                <form action="{{ route('admin.users.destroy', $user) }}"
                                      method="POST"
                                      class="inline">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Delete this user?')"
                                        class="text-red-600 hover:text-red-900 font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-500">
                                No users found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>



@foreach($users as $user)
<div id="editModal-{{ $user->id }}"
     class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Edit User
            </h2>

            <button onclick="closeModal({{ $user->id }})"
                    class="text-gray-400 hover:text-gray-600 text-xl leading-none">
                &times;
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="px-6 py-5 space-y-4">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Full Name
                </label>
                <input type="text"
                       name="name"
                       value="{{ $user->name }}"
                       class="w-full rounded-lg border-gray-300 text-sm
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email Address
                </label>
                <input type="email"
                       name="email"
                       value="{{ $user->email }}"
                       class="w-full rounded-lg border-gray-300 text-sm
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    New Password
                </label>
                <input type="password"
                       name="password"
                       placeholder="Leave blank to keep current"
                       class="w-full rounded-lg border-gray-300 text-sm
                              focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Role
                </label>
                <select name="role"
                        class="w-full rounded-lg border-gray-300 text-sm
                               focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="user"  @selected($user->role === 'user')>User</option>
                    <option value="staff" @selected($user->role === 'staff')>Staff</option>
                    <option value="admin" @selected($user->role === 'admin')>Admin</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button"
                        onclick="closeModal({{ $user->id }})"
                        class="px-4 py-2 text-sm rounded-lg bg-gray-100 text-gray-700 hover:bg-gray-200">
                    Cancel
                </button>

                <button type="submit"
                        class="px-5 py-2 text-sm rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endforeach

<div id="createUserModal"
     class="fixed inset-0 z-50 hidden bg-black/40 backdrop-blur-sm flex items-center justify-center">

    <div class="bg-white w-full max-w-lg rounded-xl shadow-xl overflow-hidden">

        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 border-b">
            <h2 class="text-lg font-semibold text-gray-800">
                Add New User
            </h2>

            <button onclick="closeCreateModal()"
                    class="text-gray-400 hover:text-gray-600 text-xl">
                &times;
            </button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.users.store') }}" class="px-6 py-5 space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                <input type="text" name="name" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                       class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                <select name="role" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:ring-2 focus:ring-indigo-500">
                    <option value="user">User</option>
                    <option value="staff">Staff</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t">
                <button type="button"
                        onclick="closeCreateModal()"
                        class="px-4 py-2 bg-gray-100 rounded-lg text-sm hover:bg-gray-200">
                    Cancel
                </button>

                <button type="submit"
                        class="px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>

