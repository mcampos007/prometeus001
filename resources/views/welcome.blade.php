<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prometeus Gym</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

    <div class="navbar">
        {{-- <img src="{{ asset('img/logo.jpg') }}" alt="Logo Prometeus Gym"> --}}
        <div class="logo">
            <a href="#"><img src="{{ asset('img/logo.jpg') }}" alt="Prometeus Gym Logo"
                    style="height: 100px;"></a>
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
                            <a href="{{ route('contacto') }}">Contacto</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </div>

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

    <div class="footer">
        <div id="contacto" class="section">
            <h2>Prometeus Gym</h2>
            <p>Gracias por visitar nuestro sitio web. Contáctanos para descubrir cómo podemos ayudarte a mejorar tu
                calidad de vida.</p>

            <div class="social-icons">
                <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
            </div>
        </div>

        <div class="copyright">
            <p>Powered by <a href="https://infocam.com.ar" target="_blank">Infocam</a> &copy; 2025 Todos los derechos
                reservados</p>
        </div>
    </div>

</body>

</html>
