@extends('layouts.webpage')

@section('titulo', $titulo)

@section('contenido')
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

        <div class="contact-container flex flex-col">
            <!-- Sección de información de contacto (Superior) -->
            <div class="mb-6">
                <h3 class="text-2xl font-bold">Contacto</h3>
                <p class="mt-2"><i class="fa fa-phone mr-2"></i><strong>Teléfono:</strong> +54 9 381 123 4567</p>
                <p class="mt-2"><i class="fa fa-envelope mr-2"></i><strong>Email:</strong> contacto@prometeusgym.com.ar
                </p>
            </div>

            <!-- Contenedor del mapa y formulario (Debajo, en fila en pantallas grandes) -->
            <div class="flex flex-col md:flex-row gap-6">
                <!-- Mapa (Izquierda) -->
                <div class="md:w-1/2">
                    <h2 class="text-xl font-bold mb-2">Nuestra Ubicación</h2>
                    <div class="border rounded-lg overflow-hidden shadow-lg">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4457.658770399051!2d-65.39686742375314!3d-24.77036560712124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x941bc30030eab2d3%3A0x4020d5e4233547f1!2sPROMETEO%20-%20Entrenamiento%20Inteligente!5e1!3m2!1ses-419!2sar!4v1743000897106!5m2!1ses-419!2sar"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Formulario (Derecha) -->
                <div class="md:w-1/2 bg-gray-900 p-8 rounded-lg shadow-xl text-white">
                    <h3 class="text-2xl font-bold mb-6 flex items-center">
                        <i class="fa fa-comment mr-2 text-blue-400"></i> Envíanos un mensaje
                    </h3>
                    <form action="{{ route('contacto.send') }}" method="post" class="flex flex-col space-y-4">
                        @csrf

                        <label for="nombre" class="text-sm font-semibold">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre"
                            class="p-3 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">

                        <label for="email" class="text-sm font-semibold">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required placeholder="Tu correo electrónico"
                            class="p-3 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400">

                        <label for="mensaje" class="text-sm font-semibold">Mensaje</label>
                        <textarea id="mensaje" name="mensaje" required placeholder="Escribe tu mensaje aquí" rows="5" maxlength="1000"
                            class="p-3 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
                        @error('mensaje')
                            <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                        @enderror

                        <button type="submit"
                            class="bg-blue-500 text-white py-3 px-6 rounded-lg font-bold hover:bg-blue-600 transition duration-300 shadow-lg">
                            Enviar
                        </button>
                    </form>
                </div>

            </div>
        </div>


    </div>

    </div>

    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('opacity-0');
            setTimeout(function() {
                document.getElementById(modalId).classList.add('hidden');
            }, 300); // Espera la animación de opacidad
        }
    </script>

@endsection
