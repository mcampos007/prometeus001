<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PaymentsExport;

class PaymentController extends Controller {
    //

    public function index() {
        $payments = Payment::with( 'user' )->orderBy( 'payment_date', 'desc' )->get();
        return view( 'payments.index', compact( 'payments' ) );
    }

    public function show( Payment $payment ) {
        return view( 'payments.show', compact( 'payment' ) );
    }

    public function create() {
        $users = User::where( 'role', 'socio' )->get();
        return view( 'payments.create', compact( 'users' ) );
    }

    public function store( Request $request ) {
        $request->validate( [
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'credits' => 'required|integer|min:1',
            'payment_date' => 'required|date',
            'expires_at' => 'required|date|after_or_equal:payment_date',
            'method' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:500',
        ] );

        // Crear el pago
        $payment = Payment::create( $request->all() );

        // Sumar créditos al usuario
        $user = User::find( $request->user_id );
        $user->credits += $request->credits;
        $user->credit_vto = $request->expires_at;
        $user->save();

        return redirect()->route( 'payments.index' )->with( 'success', 'Pago registrado correctamente.' );
    }

    public function history( $userId ) {
        $user = User::with( 'payments' )->findOrFail( $userId );
        return view( 'payments.history', compact( 'user' ) );
    }

    public function exportPdf( $userId ) {
        $user = User::with( 'payments' )->findOrFail( $userId );
        $pdf = PDF::loadView( 'payments.export_pdf', compact( 'user' ) );
        return $pdf->download( 'historial_pagos_'.$user->name.'.pdf' );
    }

    public function exportExcel( $userId ) {
        return Excel::download( new PaymentsExport( $userId ), 'historial_pagos.xlsx' );
    }
}
