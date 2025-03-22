<div class="navbar">
    {{-- <img src="{{ asset('img/logo.jpg') }}" alt="Logo Prometeus Gym"> --}}
    <div class="logo">
        <a href="{{ route('welcome') }}"><img src="{{ asset('img/logo.jpg') }}" alt="Prometeus Gym Logo"
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
                        <a href="{{ route('nosotros') }}">Nosotros</a>
                        <a href="{{ route('contacto') }}">Contacto</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</div>
