@extends('layouts.webpage')

@section('titulo', 'Listado de Pagos')

@section('contenido')
    <div class="container mt-4">
        <h2>Listado de Pagos</h2>
        <div class="flex justify-center py-4">
            <table class="min-w-full table-auto border-collapse border border-gray-700">
                <thead class="bg-gray-700">
                    <tr>
                        <th class="px-4 py-2  text-gray-300 text-center">Fecha</th>
                        <th class="px-4 py-2  text-gray-300 text-center">Socio</th>
                        <th class="px-4 py-2  text-gray-300 text-center">Importe</th>
                        <th class="px-4 py-2  text-gray-300 text-center">Créditos</th>
                        <th class="px-4 py-2  text-gray-300 text-center">Vto Créditos</th>
                        <th class="px-4 py-2  text-gray-300 text-center">Acciones</th>

                </thead>
                <tbody>
                    @foreach ($payments as $payment)
                        <tr>
                            <td class="border border-gray-700 px-4 py-2">{{ $payment->payment_date }}</td>
                            <td class="border border-gray-700 px-4 py-2">{{ $payment->user->name }}</td>
                            <td class="border border-gray-700 px-4 py-2">{{ $payment->amount }}</td>
                            <td class="border border-gray-700 px-4 py-2">{{ $payment->credits }}</td>
                            <td class="border border-gray-700 px-4 py-2">{{ $payment->expires_at }}</td>
                            <td class="border border-gray-700 px-4 py-2"><a
                                    href="{{ route('payments.history', $payment->user_id) }}" />Pagos</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <a href="{{ route('payments.create') }}"
                class="btn btn-primary bg-[#f39c12] hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded transition">Registrar
                nuevo pago</a>

        </div>

    </div>
@endsection
