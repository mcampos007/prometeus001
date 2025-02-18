<!-- resources/views/admin/list-clases.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center">
            {{ __('Lista de Clases') }}
        </h2>
        <h3 class="text-red-500 text-left">
            Socio: {{ $socio->name }} Créditos disponibles: {{ $socio->credits }}
        </h3>
    </x-slot>
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="p-4 mb-6 text-sm text-green-400 bg-green-900 border border-green-400 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="p-4 mb-6 text-sm text-red-400 bg-red-900 border border-red-400 rounded-lg shadow">
            {{ session('error') }}
        </div>
    @endif

    {{-- Mensajes de error --}}
    @if ($errors->any())
        <div class="p-4 mb-6 text-sm text-red-400 bg-red-900 border border-red-400 rounded-lg shadow">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if ($inscripciones->isNotEmpty())
        <div class="py-12">
            <div class="content">
                <div class="overflow-x-auto">
                    {{-- <div class="flex justify-center py-4"> --}}
                    <table class="min-w-full table-auto border-collapse border border-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                {{-- <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Profesor</th> --}}
                                <th class="px-4 py-2  text-gray-300 text-center">Horario</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Profesor</th>
                                {{-- <th class="px-4 py-2  text-gray-300 text-center">Cupos Disp.</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Créditos Req.</th> --}}
                                <th class="px-4 py-2  text-gray-300 text-center">Estado</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inscripciones as $socioClase)
                                <tr class="hover:bg-gray-600">
                                    {{-- <td class="px-4 py-2">{{ $clase->nombre }}</td>
                                <td class="px-4 py-2">{{ $clase->profesor->name ?? 'Sin asignar' }}</td> --}}
                                    <td class="px-4 py-2 border-t border-gray-700 text-left">
                                        {{ $socioClase->clase->horario->format('H:i') }}</td>
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{ $socioClase->clase->profesor->name ?? 'Sin asignar' }}
                                    </td>
                                    {{-- <td class="px-4 py-2 border-t border-gray-700"">
                                        {{ $socioClase->capacidad_maxima - $socioClase->class__registrations_count }}
                                    </td>
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{ $socioClase->creditos_requeridos }}
                                    </td> --}}
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{ ucfirst($socioClase->estado_inscripcion) }}
                                    </td>
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{-- <a href="{{ route('admin.socios-en-clase', $clase->id) }}"
                                    class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                    title="Socios en la clase">
                                    <i class="fas fa-users"></i> <!-- Ícono de agregar crédito -->
                                    <!-- Tooltip de Agregar Crédito -->
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                    </span>
                                    </a> --}}
                                        <form
                                            action="{{ route('socio.class.removeMember', ['class' => $socioClase->clase->id, 'member' => auth()->user()->id]) }}"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf

                                            <button type="submit"
                                                class="px-4 py-2 rounded-md bg-red-500 text-white text-xs hover:bg-red-600"
                                                title="Eliminar">
                                                <i class="fas fa-trash"></i>
                                            </button>


                                        </form>


                                        <!-- Formulario para eliminar la clase -->
                                        {{-- <form action="{{ route('admin.destroy-clase', $clase->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-700 transition duration-150"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta clase? Esta acción no se puede deshacer.')"
                                        title="Salir de la clase">
                                        <i class="fas fa-trash-alt"></i>

                                    </button>
                                </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- </div> --}}
                </div>

            </div>

        </div>
    @else
        <div class="py-12">
            <div class="content">
                <div class="flex justify-center py-4">

                    <form action="{{ route('socio.show-clases') }}" method="GET" class="flex items-center">
                        <label for="fecha" class="mr-2 font-bold">Selecciona una fecha:</label>
                        <input type="date" name="fecha" id="fecha" required {{-- min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"
                            max="{{ \Carbon\Carbon::now()->addDays(30)->format('Y-m-d') }}" --}}
                            {{-- value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}"  --}} class="border rounded px-3 py-2 mr-3 text-black"
                            value="{{ \Carbon\Carbon::parse($fechaSeleccionada)->format('Y-m-d') }}">
                        <button type="submit"
                            class="bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">
                            Buscar Clases
                        </button>
                    </form>
                </div>
                <div>

                </div>
                @if ($socio->credits > 0)
                    <table class="min-w-full table-auto border-collapse border border-gray-700">
                        <thead class="bg-gray-700">
                            <tr>
                                {{-- <th class="px-4 py-2">Nombre</th>
                            <th class="px-4 py-2">Profesor</th> --}}
                                <th class="px-4 py-2  text-gray-300 text-center">Horario</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Profesor</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Cupos Disp.</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Créditos Req.</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Estado</th>
                                <th class="px-4 py-2  text-gray-300 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clases as $clase)
                                <tr class="hover:bg-gray-600">
                                    {{-- <td class="px-4 py-2">{{ $clase->nombre }}</td>
                                <td class="px-4 py-2">{{ $clase->profesor->name ?? 'Sin asignar' }}</td> --}}
                                    <td class="px-4 py-2 border-t border-gray-700 text-left">
                                        {{ $clase->horario->format('H:i') }}</td>
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{ $clase->profesor->name ?? 'Sin asignar' }}
                                    </td>
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{ $clase->capacidad_maxima - $clase->class__registrations_count }}
                                    </td>
                                    <td class="px-4 py-2 border-t border-gray-700"">{{ $clase->creditos_requeridos }}
                                    </td>
                                    <td class="px-4 py-2 border-t border-gray-700"">{{ ucfirst($clase->estado) }}</td>
                                    <td class="px-4 py-2 border-t border-gray-700"">
                                        {{-- <a href="{{ route('admin.socios-en-clase', $clase->id) }}"
                                        class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                        title="Socios en la clase">
                                        <i class="fas fa-users"></i> <!-- Ícono de agregar crédito -->
                                        <!-- Tooltip de Agregar Crédito -->
                                        <span
                                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                        </span>
                                    </a> --}}
                                        <form
                                            action="{{ route('socio.class.addMember', ['class' => $clase->id, 'member' => auth()->user()->id]) }}"
                                            method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="px-4 py-2 rounded-md bg-[#f39c12] text-white text-xs hover:bg-[#e67e22]"
                                                title="Inscribirse">
                                                <i class="fas fa-user-plus"></i>
                                                <!-- Cambié text-xl a text-lg -->
                                            </button>

                                        </form>


                                        <!-- Formulario para eliminar la clase -->
                                        {{-- <form action="{{ route('admin.destroy-clase', $clase->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-600 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-700 transition duration-150"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta clase? Esta acción no se puede deshacer.')"
                                            title="Salir de la clase">
                                            <i class="fas fa-trash-alt"></i>

                                        </button>
                                    </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <x-danger-button>
                        El socio no tiene creditos disponibles
                    </x-danger-button>
                @endif
            </div>
        </div>
    @endif
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
