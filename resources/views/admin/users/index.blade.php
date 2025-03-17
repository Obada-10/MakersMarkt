@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-xl shadow-2xl max-w-6xl">
    <h1 class="text-4xl font-bold mb-8 text-gray-900">Gebruikersbeheer</h1>

    <!-- Success and Error Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg shadow-sm border border-green-200">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-lg shadow-sm border border-red-200">
            {{ session('error') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="overflow-x-auto rounded-lg shadow-md">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-50">
                <tr>
                    <th class="p-4 text-left text-gray-700 font-semibold">Naam</th>
                    <th class="p-4 text-left text-gray-700 font-semibold">Email</th>
                    <th class="p-4 text-left text-gray-700 font-semibold">Bio</th>
                    <th class="p-4 text-left text-gray-700 font-semibold">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition duration-150 ease-in-out">
                        <td class="p-4 text-gray-800">{{ $user->name }}</td>
                        <td class="p-4 text-gray-800">{{ $user->email }}</td>
                        <td class="p-4 text-gray-600">{{ $user->profile->bio ?? 'Geen bio' }}</td>
                        <td class="p-4 flex space-x-4">
                            <!-- View Button -->
                            <a href="{{ route('admin.users.show', $user) }}" class="px-4 py-2 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition duration-200 ease-in-out">
                                Bekijk
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze gebruiker wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition duration-200 ease-in-out">
                                    Verwijder
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection