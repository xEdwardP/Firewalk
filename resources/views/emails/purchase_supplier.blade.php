<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 20px; color: #333;">
    <div
        style="max-width: 600px; margin: auto; background-color: #fff; border-radius: 8px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
        <h2 style="margin-top: 0; color: #007bff;">{{ $title }}</h2>

        <p><strong>Proveedor:</strong> {{ $purchase->supplier->name }}</p>
        <p><strong>Fecha de orden:</strong> {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d/m/Y') }}</p>

        <h4 style="margin-top: 30px; margin-bottom: 10px;">🛒 Detalles de la compra</h4>
        <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
            <thead>
                <tr style="background-color: #007bff; color: #fff;">
                    <th style="padding: 8px; border: 1px solid #ddd;">Nro</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Producto</th>
                    <th style="padding: 8px; border: 1px solid #ddd;">Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($details as $detail)
                    <tr style="background-color: {{ $loop->iteration % 2 == 0 ? '#f2f2f2' : '#fff' }};">
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">{{ $loop->iteration }}
                        </td>
                        <td style="padding: 8px; border: 1px solid #ddd;">{{ $detail->product->name }}</td>
                        <td style="padding: 8px; border: 1px solid #ddd; text-align: center;">{{ $detail->quantity }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p style="margin-top: 30px;">Agradecemos su atención y quedamos atentos a su confirmación.</p>

        <p style="margin-top: 10px;">Saludos cordiales,<br><strong>Equipo de Compras</strong></p>
    </div>
</body>

</html>
