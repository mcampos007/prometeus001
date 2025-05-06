@extends('layouts.webpage')

@section('titulo', 'Listado de Pagos')

@section('contenido')
    <div class="container">
        <h2>Historial de Pagos de {{ $user->name }}</h2>
        <div>
            <a href="{{ route('payments.export.pdf', $user->id) }}" class="btn btn-danger mb-3">Exportar PDF</a>
            <a href="{{ route('payments.export.excel', $user->id) }}" class="btn btn-success mb-3">Exportar Excel</a>

        </div>

        @if ($user->payments->isEmpty())
            <p>Este socio aún no tiene pagos registrados.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Fecha de Pago</th>
                        <th>Monto</th>
                        <th>Créditos</th>
                        <th>Vence</th>
                        <th>Método</th>
                        <th>Notas</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->payments as $payment)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d/m/Y') }}</td>
                            <td>${{ number_format($payment->amount, 2) }}</td>
                            <td>{{ $payment->credits }}</td>
                            <td>{{ \Carbon\Carbon::parse($payment->expires_at)->format('d/m/Y') }}</td>
                            <td>{{ $payment->method }}</td>
                            <td>{{ $payment->notes }}</td>
                            <td>
                                @if (\Carbon\Carbon::parse($payment->expires_at)->isPast())
                                    <span class="badge bg-danger">Vencido</span>
                                @else
                                    <span class="badge bg-success">Activo</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
