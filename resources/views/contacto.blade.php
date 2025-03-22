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

        <div class="contact-container flex flex-col md:flex-row">
            <!-- Left Side (Información de contacto) -->
            <div class="">
                <h3 class="">Contacto</h3>
                <p class=""><i class="fa fa-phone mr-2"></i><strong>Teléfono:</strong> +54 9 381
                    123 4567</p>
                <p class=""><i class="fa fa-envelope mr-2"></i><strong>Email:</strong>
                    contacto@prometeusgym.com.ar</p>
                <div class="map-container mt-4">
                    <p class=""><i class="fa fa-map-marker-alt mr-2"></i><strong>Ubicación</strong></p>
                    <!-- Aquí iría el mapa embebido -->
                    {{-- <iframe class="w-full h-64 md:h-96" src="#" width="400" height="300" style="border:0;"
                        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                </div>
            </div>

            <!-- Right Side (Formulario de contacto) -->
            <div class="">
                <h3 class="">
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

    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('opacity-0');
            setTimeout(function() {
                document.getElementById(modalId).classList.add('hidden');
            }, 300); // Espera la animación de opacidad
        }
    </script>

@endsection
