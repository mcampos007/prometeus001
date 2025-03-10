<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prometeus Gym</title>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

    <div class="navbar">
        {{-- <img src="{{ asset('img/logo.jpg') }}" alt="Logo Prometeus Gym"> --}}
        <div class="logo">
            <a href="#"><img src="{{ asset('img/logo.jpg') }}" alt="Prometeus Gym Logo" style="height: 100px;"></a>
        </div>

        <div class="menu">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Ingresar</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Registrar</a>
                            {{-- <a href="#inicio">Inicio</a> --}}
                            <a href="{{ route('horarios') }}">Horarios</a>
                            <a href="#nosotros">Nosotros</a>
                            <a href="#contacto">Contacto</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </div>
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


</body>

</html>
