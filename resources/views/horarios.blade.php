@extends('layouts.webpage')

@section('titulo', $titulo)

@section('contenido')
    <div class="container">
        <div id="inicio" class="section">
            <h2 id="hnuestros">Nuestros</h2>
            <h2 id="hhorarios">Horarios</h2>
            <p>LUNES - MIERCOLES - VIERNES</p>
            <P>8.00 A 13.00 | 15.00 A 21.00</P>
            <p>MARTES - JUEVES</p>
            <P>8.00 A 13.00 | 15.00 A 20.00</P>
            <div class="section001">
                <div class="content001">
                    <p>ELEGI EL HORARIO QUE MEJOR SE ADAPTE A TU RUTINA</p>
                    <img src="{{ asset('img/tilde.png') }}" alt="" class="imgtilde">
                </div>
            </div>
        </div>


    </div>
@endsection
