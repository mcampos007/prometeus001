<?php
namespace App\Exports;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentsExport implements FromView {
    protected $userId;

    public function __construct( $userId ) {
        $this->userId = $userId;
    }

    public function view(): View {
        $user = User::with( 'payments' )->findOrFail( $this->userId );
        return view( 'payments.export_excel', compact( 'user' ) );
    }
}

