@extends('components.layout')

@section('content')
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">📦 Mijn Bestellingen</h1>

            @if($orders->isEmpty())
                <p class="text-center text-gray-500">Je hebt nog geen bestellingen geplaatst.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-700 bg-white rounded-lg shadow-md overflow-hidden">
                        <thead class="bg-blue-600 text-white text-sm uppercase">
                            <tr>
                                <th class="px-6 py-3">Product(en)</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Adres</th>
                                <th class="px-6 py-3">Telefoon</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">Prijs</th>
                                <th class="px-6 py-3">Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        @if($order->products->isEmpty())
                                            <span class="text-gray-500">Onbekend Product</span>
                                        @else
                                            {{ $order->products->pluck('name')->join(', ') }}
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        @if(auth()->check() && auth()->user()->role === 'moderator')
                                            <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()"
                                                    class="w-full p-2 rounded border text-sm
                                                        {{ 
                                                            $order->status === 'In productie' ? 'bg-yellow-300 text-gray-800' :
                                                            ($order->status === 'Verzonden' ? 'bg-green-500 text-white' :
                                                            'bg-red-500 text-white') 
                                                        }}"
                                                    disabled>
                                                    <option value="In productie" {{ $order->status == 'In productie' ? 'selected' : '' }}>In productie</option>
                                                    <option value="Verzonden" {{ $order->status == 'Verzonden' ? 'selected' : '' }}>Verzonden</option>
                                                    <option value="Geweigerd" {{ $order->status == 'Geweigerd' ? 'selected' : '' }}>Geweigerd</option>
                                                </select>
                                            </form>
                                        @else
                                            <span class="inline-block px-3 py-1 rounded text-xs font-semibold
                                                {{
                                                    $order->status === 'In productie' ? 'bg-yellow-300 text-gray-800' :
                                                    ($order->status === 'Verzonden' ? 'bg-green-500 text-white' :
                                                    'bg-red-500 text-white')
                                                }}">
                                                {{ $order->status }}
                                            </span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">{{ $order->address }}, {{ $order->city }}</td>
                                    <td class="px-6 py-4">{{ $order->phone_number }}</td>
                                    <td class="px-6 py-4">{{ $order->email }}</td>
                                    <td class="px-6 py-4 font-medium">&euro;{{ number_format($order->total_price, 2, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ $order->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a href="{{ route('products.index') }}" class="text-blue-500 mt-4 inline-block">← Terug naar overzicht</a>
                </div>
            @endif
        </div>
    </div>
@endsection
