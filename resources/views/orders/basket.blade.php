@extends('components.layout')

@section('content')
    <div class="py-12 bg-gray-100 min-h-screen">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">🛒 Mijn Winkelmandje</h1>

            <form action="{{ route('orders.checkout') }}" method="GET" id="checkoutForm">
                @csrf

                <div class="bg-white shadow-lg rounded-xl overflow-hidden grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
                    <div class="md:col-span-2 space-y-4">
                        @if($basket_content->isEmpty())
                            <p class="text-center text-gray-500">Je hebt nog geen producten in je winkelmandje.</p>
                        @else
                            @foreach($basket_content as $item)
                                <div class="flex justify-between items-center border-b pb-4">
                                    <div>
                                        <div class="text-lg font-semibold text-gray-800">{{ $item->product->name ?? 'Geen product' }}</div>
                                        <div class="text-green-600 font-medium">€{{ number_format($item->product->price, 2) }}</div>
                                    </div>
                                    <input type="checkbox" class="product-checkbox w-5 h-5 text-blue-500" 
                                        data-price="{{ $item->product->price }}" 
                                        data-id="{{ $item->id }}"
                                        onchange="updateTotal()">
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 shadow-md space-y-4">
                        <h2 class="text-xl font-semibold text-gray-700 text-center">Totaalprijs</h2>

                        <div class="flex justify-between text-gray-600">
                            <span>Subtotaal:</span>
                            <span id="subtotal">€0,00</span>
                        </div>

                        <div class="flex justify-between text-gray-600">
                            <span>Verzendkosten:</span>
                            <span>€5,00</span>
                        </div>

                        <div class="flex justify-between text-lg font-bold text-gray-800 border-t pt-2">
                            <span>Totaal:</span>
                            <span id="total">€5,00</span>
                        </div>

                        <input type="hidden" name="selected_products" id="selectedProducts">
                        <input type="hidden" name="total_price" id="totalPrice">

                        <button type="submit" 
                                onclick="prepareCheckout(event)" 
                                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                            Afrekenen
                        </button>
                    </div>
                    <a href="{{ route('products.index') }}" class="text-blue-500 mt-4 inline-block">← Terug naar overzicht</a>
                </div>
            </form>

        </div>
    </div>

    <script>
        function updateTotal() {
            let subtotal = 0;
            const shipping = 5.00;

            document.querySelectorAll('.product-checkbox:checked').forEach(function (checkbox) {
                subtotal += parseFloat(checkbox.getAttribute('data-price'));
            });

            const total = subtotal + shipping;

            document.getElementById('subtotal').innerText = '€' + subtotal.toFixed(2).replace('.', ',');
            document.getElementById('total').innerText = '€' + total.toFixed(2).replace('.', ',');
        }

        function prepareCheckout(event) {
            const selectedProducts = [];
            document.querySelectorAll('.product-checkbox:checked').forEach(function (checkbox) {
                selectedProducts.push(checkbox.getAttribute('data-id'));
            });

            if (selectedProducts.length === 0) {
                event.preventDefault();
                alert("Selecteer ten minste één product om af te rekenen.");
                return;
            }

            document.getElementById('selectedProducts').value = selectedProducts.join(',');
            const totalText = document.getElementById('total').innerText.replace('€', '').replace(',', '.');
            document.getElementById('totalPrice').value = parseFloat(totalText).toFixed(2);
        }
    </script>
@endsection
