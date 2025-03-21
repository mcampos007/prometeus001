<!-- resources/views/admin/list-clases.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center">
            {{ __('Lista de Clases') }}
        </h2>
    </x-slot>
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="p-4 mb-6 text-sm text-green-400 bg-green-900 border border-green-400 rounded-lg shadow">
            {{ session('success') }}
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



    <div class="py-12">
        <div class="content">
            <div class="flex justify-center py-4">
                <a href="{{ route('admin.generate-classes') }}"
                    class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">

                    Agregar Clase para el mes

                </a>
                <a href="{{ route('admin.bloqueardia') }}"
                    class="ml-3  bg-red-500 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-900">
                    <i class="fas fa-lock"></i>
                    <span>Bloquear Todo un día</span>

                </a>
                {{-- <form action="{{ route('admin.bloquear-day-clase', $clase->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PUT')
                    <button class="ml-3  bg-red-500 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-900"
                        type="submit" value="Bloquear Todo el día">
                        <i class="fas fa-lock"></i><span> Bloquear Todo el Día</span>
                    </button>
                </form> --}}
            </div>
            <div class="flex justify-center py-4">

                <form action="{{ route('admin.list-clases') }}" method="GET" class="flex items-center">
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
                                <a href="{{ route('admin.socios-en-clase', $clase->id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-blue-600 transition duration-150 mr-2"
                                    title="Administrar clase">
                                    <i class="fas fa-users"></i> <!-- Ícono de agregar crédito -->
                                    <!-- Tooltip de Agregar Crédito -->
                                    <span
                                        class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                    </span>
                                </a>

                                <!-- Formulario para eliminar la clase -->
                                <form action="{{ route('admin.destroy-clase', $clase->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-700 transition duration-150"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta clase? Esta acción no se puede deshacer.')"
                                        title="Eliminar clase">
                                        <i class="fas fa-trash-alt"></i>

                                    </button>
                                </form>

                                <!-- Formulario para bloquear la clase -->
                                <form action="{{ route('admin.bloquear-clase', $clase->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class=" bg-yellow-400 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-yellow-700 transition duration-150 "
                                        onclick="return confirm('¿Estás seguro de que deseas bloquear esta clase? Esta acción no se puede deshacer.')"
                                        title="Bloquear/Desbloquear clase">
                                        <i class="fas fa-lock"></i>

                                    </button>
                                </form>
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
