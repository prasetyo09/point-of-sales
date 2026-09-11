<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk #{{ $transaction->order_code }}</title>
    <style>
        @page {
            margin: 5px;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 10px;
            line-height: 1.2;
            color: #000;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .divider {
            border-top: 1px dashed #000;
            margin: 6px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 2px 0;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <div class="text-center">
        <strong>POS - Laundry</strong><br>
        Jl. Karet Pasar Baru Barat V No. 23, Jakarta Pusat<br>
        Telp: 0812-0000-0000
    </div>

    <div class="divider"></div>

    <table>
        <tr>
            <td>Payment Code: {{ $transaction->order_number }}</td>
            <td class="text-right">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td colspan="2">Status: {{ strtoupper($transaction->payment_status) == 1 ? 'Success' : 'Failed'   }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <table>
        {{-- Jika ada daftar item detail --}}
        @if($transaction->items && $transaction->items->count() > 0)
            @foreach($transaction->items as $item)
            <tr>
                <td colspan="3">{{ $item->product->name ?? $item->name }}</td>
            </tr>
            <tr>
                <td style="width: 35%;">{{ $item->qty }} x {{ number_format($item->product->price, 2, ',', '.') }}</td>
                <td></td>
                <td class="text-right" style="width: 40%;">{{ number_format($item->subtotal ?? ($item->qty * $item->product->price), 0, ',', '.') }}</td>
            </tr>
            @endforeach
        @else
            <tr>
                <td colspan="2">Total Belanja</td>
                <td class="text-right">Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</td>
            </tr>
        @endif
    </table>

    <div class="divider"></div>

    <table>
        <tr>
            <td><strong>TOTAL BILL</strong></td>
            <td class="text-right"><strong>Rp {{ number_format($transaction->total_price, 2, ',', '.') }}</strong></td>
        </tr>
        <tr>
            <td>Change</td>
            <td class="text-right">Rp {{ number_format($transaction->change, 2, ',', '.') }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="text-center">
        Thank you for your visit!<br>
        Goods that have been purchased cannot be exchanged!
    </div>
</body>
</html>
