<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prometeus Gym - {{ $title }}</title>

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
        <!-- Modal Success -->
        @if (session('success'))
            <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
                <div class="bg-green-200 text-green-800 p-6 rounded-lg shadow-xl w-96">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-semibold">¡Éxito!</h4>
                        <button type="button" class="text-green-800" onclick="closeModal('successModal')">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <p class="mt-2">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Modal Error -->
        @if (session('error'))
            <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
                <div class="bg-red-200 text-red-800 p-6 rounded-lg shadow-xl w-96">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-semibold">¡Error!</h4>
                        <button type="button" class="text-red-800" onclick="closeModal('errorModal')">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <p class="mt-2">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="contact-container flex flex-col md:flex-row">
            <!-- Left Side (Información de contacto) -->
            <div class="contact-info flex-1 mb-4 md:mb-0">
                <h3 class="text-2xl font-semibold">Contacto</h3>
                <p class="flex items-center mt-4"><i class="fa fa-phone mr-2"></i><strong>Teléfono:</strong> +54 9 381
                    123 4567</p>
                <p class="flex items-center mt-4"><i class="fa fa-envelope mr-2"></i><strong>Email:</strong>
                    contacto@prometeusgym.com.ar</p>
                <div class="map-container mt-4">
                    <p class="flex items-center"><i class="fa fa-map-marker-alt mr-2"></i><strong>Ubicación</strong></p>
                    <!-- Aquí iría el mapa embebido -->
                    <iframe class="w-full h-64 md:h-96" src="http://#" width="400" height="300" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Right Side (Formulario de contacto) -->
            <div class="contact-form flex-1 flex flex-col justify-between">
                <h3 class="flex items-center text-2xl font-semibold mb-2">
                    <i class="fa fa-comment mr-2"></i> Envíanos un mensaje
                </h3>
                <form action="{{ route('contacto.send') }}" method="post" class="flex flex-col">
                    @csrf
                    <label for="nombre" class="mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre"
                        class="mb-2 p-2 border border-gray-300 rounded">
                    <label for="email" class="mb-1">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="Tu correo electrónico"
                        class="mb-2 p-2 border border-gray-300 rounded">
                    <label for="mensaje" class="mb-1">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" required placeholder="Escribe tu mensaje aquí" rows="8" maxlength="1000"
                        class="mb-4 p-2 border border-gray-300 rounded"></textarea>
                    @error('mensaje')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="self-end bg-blue-500 text-white py-2 px-4 rounded">Enviar</button>
                </form>
            </div>
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
<script>
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('opacity-0');
        setTimeout(function() {
            document.getElementById(modalId).classList.add('hidden');
        }, 300); // Espera la animación de opacidad
    }
</script>

</html>
