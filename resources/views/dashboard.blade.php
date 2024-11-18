<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg shadow-md">
            <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg shadow-md">
            <strong>¡Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Botones para redirigir a las vistas de socios y agregar crédito -->
                    <div class="flex space-x-4 my-4">
                        <!-- Botón para ver la lista de Clases -->
                        <a href="{{ route('admin.list-clases') }}"
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Clases
                        </a>
                    </div>
                    <div class="flex space-x-4 my-4">
                        <!-- Botón para ver la lista de socios -->
                        <a href="{{ route('list-socios') }}"
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Socios
                        </a>
                    </div>

                    <div class="flex space-x-4 my-4">
                        <!-- Botón para ver la Dias de Trabajo -->
                        <a href="{{ route('work_days.index') }}"
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Días de Trabajo
                        </a>
                    </div>
                    <div class="flex space-x-4">
                        <!-- Botón para ver la lista de Profesores -->
                        <a href="{{ route('list-profes') }}"
                            class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                            Profesores
                        </a>
                    </div>

                    <!-- Botón para agregar crédito a los socios -->
                    {{-- <a href="{{ route('admin.add-credits') }}"
                            class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                            Agregar Crédito a Socios
                        </a> --}}
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
