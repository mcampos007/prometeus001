<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller {

    public function welcome() {
        return view ( 'welcome' );
    }
    //

    public function horarios() {
        return view ( 'horarios' );
    }
}
