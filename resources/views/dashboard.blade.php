<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">
            {{ strtoupper(__('PANEL DE CONTROL')) }}
        </h2>

    </x-slot>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div
            style="padding: 1rem; margin-bottom: 1rem; background-color: #2ecc71; color: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);">
            <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div
            style="padding: 1rem; margin-bottom: 1rem; background-color: #e74c3c; color: #fff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);">
            <strong>¡Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="content">
            <!-- Contenido según el rol del usuario -->
            @if (auth()->user()->hasRole('administrador'))
                <!-- Botones para redirigir a las vistas como administrador-->
                <div class="form-container">
                    <!-- Botón para ver la lista de Clases -->
                    <a href="{{ route('admin.list-clases') }}"
                        style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                        Clases
                    </a>

                    <!-- Botón para ver la lista de socios -->
                    <a href="{{ route('list-socios') }}"
                        style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                        Socios
                    </a>

                    <!-- Botón para ver los Días de Trabajo -->
                    <a href="{{ route('work_days.index') }}"
                        style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                        Días de Trabajo
                    </a>

                    <!-- Botón para ver la lista de Profesores -->
                    <a href="{{ route('list-profes') }}"
                        style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                        Profesores
                    </a>

                    <!-- Botón para agregar crédito a los socios -->
                    {{-- <a href="{{ route('admin.add-credits') }}" style="display: block; background-color: #27ae60; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                    Agregar Crédito a Socios
                </a> --}}
                </div>
            @elseif(auth()->user()->hasRole('socio'))
                <!-- Botones para redirigir a las vistas de socios  -->
                <div class="form-container">
                    <h1 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">Bienvenido
                        {{ auth()->user()->name }}</h1>

                    <div style="text-align: center; margin-top: 15px;">
                        <a href="{{ route('socio.show-clases') }}" class="btn btn-primary">
                            Ver Clases Disponibles Hoy
                        </a>
                    </div>


                </div>
            @elseif(auth()->user()->hasRole('profesor'))
                <!-- Botones para redirigir a las vistas de profesores  -->
                <div class="form-container"></div>
            @else
                <p>Acceso No autorizado</p>
            @endif

        </div>
    </div>
</x-app-layout>
