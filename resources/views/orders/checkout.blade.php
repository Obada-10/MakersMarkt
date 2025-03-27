<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afrekenen</title>
    <style>
        body, h1, form, label, input, button {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        
        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Ensure responsiveness */
        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }

            h1 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Afrekenen</h1>
        <form action="{{ route('orders.processCheckout') }}" method="POST">
            @csrf
            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" required>

            <label for="address">Adres:</label>
            <input type="text" id="address" name="address" required>

            <label for="street_name">Straatnaam:</label>
            <input type="text" id="street_name" name="street_name" required>

            <label for="postal_code">Postcode:</label>
            <input type="text" id="postal_code" name="postal_code" required>

            <label for="city">Stad:</label>
            <input type="text" id="city" name="city" required>

            <label for="phone_number">Telefoonnummer:</label>
            <input type="text" id="phone_number" name="phone_number" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="total_price">Totaalprijs:</label>
            <input type="number" id="total_price" name="total_price" value="{{ $total }}" readonly>

            <button type="submit">Bestelling plaatsen</button>
            <input type="hidden" name="selected_products" id="selectedProducts">
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedProducts = [];
            let shippingCost = 5.00;

            function updateTotal() {
                let subtotal = selectedProducts.reduce((total, product) => total + product.price, 0);
                let total = subtotal + shippingCost;
                document.getElementById('total_price').value = total.toFixed(2); // Update the total price field
            }

            document.querySelectorAll('.product-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const productId = this.dataset.id;
                    const productPrice = parseFloat(this.dataset.price);
                    
                    if (this.checked) {
                        selectedProducts.push({id: productId, price: productPrice});
                    } else {
                        selectedProducts = selectedProducts.filter(product => product.id !== productId);
                    }

                    updateTotal();
                });
            });
        });
    </script>
</body>
</html>
