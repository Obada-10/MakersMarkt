<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestellingen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f8f9fa;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        .status {
            font-weight: bold;
            padding: 8px 10px;
            border-radius: 5px;
            text-align: center;
            min-width: 120px;
            font-size: 14px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .status-in-productie { background-color: #ffc107; color: #212529; }
        .status-verzonden { background-color: #28a745; color: white; }
        .status-geweigerd { background-color: #dc3545; color: white; }
        select {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background: #fff;
        }
    </style>
</head>
<body>
    <h1>Mijn Bestellingen</h1>
    
    @if($orders->isEmpty())
        <p>Je hebt nog geen bestellingen geplaatst.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Product(en)</th>
                    <th>Status</th>
                    <th>Adres</th>
                    <th>Telefoon</th>
                    <th>Email</th>
                    <th>Prijs</th>
                    <th>Datum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            @if($order->products->isEmpty())
                                Onbekend Product
                            @else
                                {{ $order->products->pluck('name')->join(', ') }}
                            @endif
                        </td>
                        <td>
                            @if(auth()->check() && auth()->user()->role === 'moderator')
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="status">
                                        <option value="In productie" {{ $order->status == 'In productie' ? 'selected' : '' }}>In productie</option>
                                        <option value="Verzonden" {{ $order->status == 'Verzonden' ? 'selected' : '' }}>Verzonden</option>
                                        <option value="Geweigerd" {{ $order->status == 'Geweigerd' ? 'selected' : '' }}>Geweigerd</option>
                                    </select>
                                </form>
                            @else
                                <span class="status status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">{{ $order->status }}</span>
                            @endif
                        </td>                        
                        <td>{{ $order->address }}, {{ $order->city }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->email }}</td>
                        <td>&euro;{{ number_format($order->total_price, 2, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
