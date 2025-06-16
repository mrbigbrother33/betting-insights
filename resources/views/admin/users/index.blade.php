<x-layout title="Brugere">
    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-2xl font-bold mb-6 text-indigo-700">Brugeradministration</h1>

        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif

        <div class="overflow-x-auto bg-white shadow rounded border border-gray-200">
            <table class="min-w-full table-auto text-sm text-left">
                <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">Navn</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Rolle</th>
                        <th class="px-4 py-3">Oprettet</th>
                        <th class="px-4 py-3 text-right">Handling</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-t">
                            <td class="px-4 py-3">{{ $user->name }}</td>
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3">
                                @if ($user->is_admin)
                                    <span class="inline-block px-2 py-0.5 text-xs bg-indigo-100 text-indigo-700 rounded">Admin</span>
                                @else
                                    <span class="inline-block px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded">Bruger</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
