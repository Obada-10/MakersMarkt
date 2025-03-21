<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Winkelmandje</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            display: flex;
            justify-content: space-between;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .left-section {
            flex: 2;
            padding-right: 20px;
        }
        .right-section {
            flex: 1;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .product {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .product:last-child {
            border-bottom: none;
        }
        .product-info {
            display: flex;
            flex-direction: column;
        }
        .product-name {
            font-size: 16px;
            font-weight: bold;
        }
        .product-price {
            color: #28a745;
        }
        .pricing {
            text-align: center;
        }
        .price-info {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
        }
        .total {
            font-weight: bold;
            font-size: 18px;
        }
        .btn {
            display: block;
            width: 100%;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
        .empty-message {
            text-align: center;
            color: #888;
        }
    </style>
</head>
<body>
    <h1>Mijn Winkelmandje</h1>
    <form action="{{ route('orders.checkout') }}" method="get" id="checkoutForm">
        @csrf
        <div class="container">
            <div class="left-section">
                @if($basket_content->isEmpty())
                    <p class="empty-message">Je hebt nog geen producten in je winkelmandje.</p>
                @else
                    @foreach($basket_content as $item)
                        <div class="product">
                            <div class="product-info">
                                <div class="product-name">{{ $item->product->name ?? 'Geen product' }}</div>
                                <div class="product-price">€{{ number_format($item->product->price, 2) }}</div>
                            </div>
                            <input type="checkbox" class="product-checkbox" data-price="{{ $item->product->price }}" data-id="{{ $item->id }}" onchange="updateTotal()">
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="right-section">
                <div class="pricing">
                    <div class="title">Totaalprijs</div>
                    <div class="price-info">
                        <span>Subtotaal:</span>
                        <span id="subtotal">€0,00</span>
                    </div>
                    <div class="price-info">
                        <span>Verzendkosten:</span>
                        <span>€5,00</span>
                    </div>
                    <div class="price-info total">
                        <span>Totaal:</span>
                        <span id="total">€5,00</span>
                    </div>
                    <button type="submit" class="btn" onclick="prepareCheckout(event)">Afrekenen</button>
                </div>
            </div>
        </div>
        <!-- Hidden Input for Selected Products -->
        <input type="hidden" name="selected_products" id="selectedProducts">
        <input type="hidden" name="total_price" id="totalPrice">
    </form>
    
    <script>
        function updateTotal() {
            let subtotal = 0;
            let shipping = 5.00;
            document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
                subtotal += parseFloat(checkbox.getAttribute('data-price'));
            });
            let total = subtotal + shipping;
            document.getElementById('subtotal').innerText = '€' + subtotal.toFixed(2);
            document.getElementById('total').innerText = '€' + total.toFixed(2);
        }

        function prepareCheckout(event) {
            let selectedProducts = [];
            document.querySelectorAll('.product-checkbox:checked').forEach(function(checkbox) {
                selectedProducts.push(checkbox.getAttribute('data-id'));
            });

            // If no products are selected, prevent form submission
            if (selectedProducts.length === 0) {
                event.preventDefault();
                alert("Selecteer ten minste één product om af te rekenen.");
                return;
            }

            // Pass selected products to the hidden input
            document.getElementById('selectedProducts').value = selectedProducts.join(',');

            // Pass the total price to the hidden input
            let totalPrice = parseFloat(document.getElementById('total').innerText.replace('€', '').replace(',', '.'));
            document.getElementById('totalPrice').value = totalPrice.toFixed(2);
        }
    </script>
</body>
</html>
