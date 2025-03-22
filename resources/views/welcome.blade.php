@extends('layouts.webpage')

@section('titulo', $titulo)

@section('contenido')
    <div class="container">
        <div id="inicio" class="section">
            <h2>Bienvenido a Prometeus Gym</h2>
            <p>Tu lugar para alcanzar el máximo potencial físico y mental.</p>
        </div>

        <div id="mision" class="section">
            <h2>Misión</h2>
            <p>Brindar un espacio donde nuestros socios puedan mejorar su salud física y mental a través del ejercicio y
                el bienestar.</p>
        </div>

        <div id="vision" class="section">
            <h2>Visión</h2>
            <p>Ser el gimnasio líder en la comunidad, reconocido por su excelencia en servicios e instalaciones.</p>
        </div>

        <div id="valores" class="section">
            <h2>Valores</h2>
            <p>Compromiso, excelencia, innovación y respeto hacia todos nuestros socios.</p>
        </div>

        <div id="objetivos" class="section">
            <h2>Objetivos</h2>
            <p>Ayudar a nuestros socios a alcanzar sus metas de salud y estado físico, ofreciendo programas
                personalizados y atención de calidad.</p>
        </div>


    </div>
@endsection
