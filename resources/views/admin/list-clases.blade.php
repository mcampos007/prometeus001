<!-- resources/views/admin/list-clases.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Clases') }}
        </h2>
    </x-slot>
    @if (session('success'))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    {{-- <div class="flex justify-center py-4">
        <a href="{{ route('admin.add-clases') }}">
            <x-primary-button>
                Agregar Clase
            </x-primary-button>
        </a>
    </div>
     --}}
    <div class="flex justify-center py-4">
        <a href="{{ route('admin.generate-classes') }}">
            <x-primary-button>
                Agregar Clase para el mes
            </x-primary-button>
        </a>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr>
                        {{-- <th class="px-4 py-2">Nombre</th>
                        <th class="px-4 py-2">Profesor</th> --}}
                        <th class="px-4 py-2">Horario</th>
                        <th class="px-4 py-2">Cupos Disp.</th>
                        <th class="px-4 py-2">Créditos Req.</th>
                        <th class="px-4 py-2">Estado</th>
                        <th class="px-4 py-2">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clases as $clase)
                        <tr>
                            {{-- <td class="px-4 py-2">{{ $clase->nombre }}</td>
                            <td class="px-4 py-2">{{ $clase->profesor->name ?? 'Sin asignar' }}</td> --}}
                            <td class="px-4 py-2">{{ $clase->horario->format('H:i') }}</td>
                            <td class="px-4 py-2">
                                {{ $clase->capacidad_maxima - $clase->class__registrations_count }}
                            </td>
                            <td class="px-4 py-2">{{ $clase->creditos_requeridos }}
                            </td>
                            <td class="px-4 py-2">{{ ucfirst($clase->estado) }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('admin.socios-en-clase', $clase->id) }}"
                                    class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                    title="Socios en la clase">
                                    <i class="fas fa-users"></i> <!-- Ícono de agregar crédito -->
                                    <!-- Tooltip de Agregar Crédito -->
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                    </span>
                                </a>
                                <a href="{{ route('admin.socios-en-clase', $clase->id) }}"
                                    class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                    title="Socios en la clase">
                                    <i class="fas fa-users"></i> <!-- Ícono de agregar crédito -->
                                    <!-- Tooltip de Agregar Crédito -->
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const container = document.getElementById("responsive-container");
            if (window.innerWidth <= 600) {
                container.classList.add("mobile-view");
            } else {
                container.classList.add("desktop-view");
            }
        });
    </script>
@endsection
