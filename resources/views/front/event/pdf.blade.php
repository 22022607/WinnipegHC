<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Ticket - {{ $order->ticket_code }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .ticket {
            border: 2px dashed #4f46e5;
            padding: 20px;
            text-align: center;
        }
        .qr {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h1>{{ $order->event->title }}</h1>
        <p><strong>Date:</strong> {{ $order->event->date->format('d M Y') }}</p>
        <p><strong>Ticket:</strong> {{ $order->ticket->name }}</p>
        <p><strong>Quantity:</strong> {{ $order->quantity }}</p>
        <p><strong>Ticket Code:</strong> {{ $order->ticket_code }}</p>

        <div class="qr">
            {!! QrCode::size(150)->generate(route('ticket.show', $order->id)) !!}
        </div>
    </div>
</body>
</html>
