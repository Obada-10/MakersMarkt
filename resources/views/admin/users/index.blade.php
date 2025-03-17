@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8 bg-white rounded-lg shadow-lg max-w-4xl">
    <h1 class="text-3xl font-semibold mb-6 text-gray-800">Gebruikersbeheer</h1>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg shadow-md">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg shadow-md">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-4 text-left text-gray-700">Naam</th>
                    <th class="p-4 text-left text-gray-700">Email</th>
                    <th class="p-4 text-left text-gray-700">Bio</th>
                    <th class="p-4 text-left text-gray-700">Acties</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b hover:bg-gray-50 transition duration-200">
                        <td class="p-4 text-gray-700">{{ $user->name }}</td>
                        <td class="p-4 text-gray-700">{{ $user->email }}</td>
                        <td class="p-4 text-gray-500">{{ $user->profile->bio ?? 'Geen bio' }}</td>
                        <td class="p-4">
                            <a href="{{ route('admin.users.show', $user) }}" class="text-blue-500 hover:text-blue-700 transition duration-200">Bekijk</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 transition duration-200">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
