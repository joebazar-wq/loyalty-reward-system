<x-app-layout>
<div class="container mx-auto p-6">

    <h1 class="text-2xl font-bold mb-4">Manage User Points</h1>

    <table class="w-full bg-white shadow rounded mb-6">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">User</th>
                <th class="p-2 text-left">Current Points</th>
                <th class="p-2 text-left">Add Points</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="border-b">
                <td class="p-2">{{ $user->name }}</td>
                <td class="p-2">{{ $user->points }}</td>
                <td class="p-2">
                    <form action="{{ route('points.add', $user) }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="number" name="points" placeholder="Points" class="border rounded px-2 py-1 w-24">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                            Add
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
</x-app-layout>