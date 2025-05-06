<h2>Historial de Pagos - {{ $user->name }}</h2>
<table border="1" cellspacing="0" cellpadding="5" width="100%">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Créditos</th>
            <th>Vence</th>
            <th>Método</th>
            <th>Notas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user->payments as $p)
            <tr>
                <td>{{ \Carbon\Carbon::parse($p->payment_date)->format('d/m/Y') }}</td>
                <td>${{ number_format($p->amount, 2) }}</td>
                <td>{{ $p->credits }}</td>
                <td>{{ \Carbon\Carbon::parse($p->expires_at)->format('d/m/Y') }}</td>
                <td>{{ $p->method }}</td>
                <td>{{ $p->notes }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
<p style="margin-top: 20px;">Este informe fue generado el {{ \Carbon\Carbon::now()->format('d/m/Y H:i:s') }}</p>
<p style="margin-top: 20px;">Este informe fue generado por {{ auth()->user()->name }}</p>
