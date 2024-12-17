<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center">
            {{ __('Gestión de Socios para la Clase: ') }}
            {{ $class->nombre }}{{ __(' - ') }}{{ $class->horario_formatted }}
        </h2>
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center mt-2">
            {{ __('Estado de la Clase: ') }}{{ $class->estado }}
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

    <!-- Contenedor principal -->
    <div class="container">
        <div class="content">

            <!-- Socios ya inscriptos -->
            <div class="form-container">
                @if ($class->class_Registrations->isEmpty())
                    <x-alert type="danger">
                        No hay socios inscriptos en esta clase.
                    </x-alert>
                @else
                    <h3 class="text-lg font-medium text-[#f39c12] mb-4">Socios Inscriptos</h3>
                    <!-- Botón para iniciar la clase -->
                    @if ($class->estado == 'pendiente')
                        <form action="{{ route('class.start', ['class' => $class->id]) }}" method="POST"
                            class="mt-4 mb-4">
                            @csrf
                            <button type="submit" class="px-4 py-2 bg-[#f39c12] text-white rounded hover:bg-[#e67e22]">
                                Iniciar Clase
                            </button>
                        </form>
                    @elseif($class->estado == 'iniciada')
                        <form id="end-class-form" action="{{ route('class.end', ['class' => $class->id]) }}"
                            method="POST" class="mt-4 mb-4">
                            @csrf
                            <button type="button" class="px-4 py-2 bg-[#f39c12] text-white rounded hover:bg-[#e67e22]"
                                id="end-class-btn">
                                Finalizar Clase
                            </button>

                        </form>
                    @endif
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-800 text-gray-400 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-2">Nombre</th>
                                <th class="px-4 py-2">Estado</th>
                                <th class="px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($class->class_Registrations as $member)
                                <tr class="border-b border-gray-600">
                                    <td class="px-4 py-2">{{ $member->socio->name }}</td>
                                    <td class="px-4 py-2">{{ $member->estado_inscripcion ?? 'Pendiente' }}</td>
                                    <td class="px-4 py-2">
                                        @if ($class->estado != 'finalizada')
                                            <div class="flex items-center space-x-2">
                                                <!-- Formulario para quitar socio -->
                                                <form
                                                    action="{{ route('class.removeMember', ['class' => $class->id, 'member' => $member->socio_id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Estás seguro de que deseas quitar este socio de la clase?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                                                        title="Quitar de la Clase">
                                                        <i class="fas fa-trash-alt"></i>

                                                    </button>
                                                </form>

                                                <form
                                                    action="{{ route('class.setPresent', ['class' => $class->id, 'member' => $member->socio_id]) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('¿Confirmar Presente para el socio?');">
                                                    @csrf

                                                    <button type="submit"
                                                        class="px-4 py-2 bg-lime-500 text-white rounded hover:bg-lime-700 disabled:bg-gray-400 disabled:cursor-not-allowed"
                                                        title="Presente en la clase">

                                                        <i class="fas fa-user-check"></i>

                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                @endif
            </div>

            @if ($class->estado != 'finalizada')
                <!-- Socios disponibles para inscribir -->
                <div class="form-container mt-6">

                    @if ($class->class_Registrations->count() < $class->capacidad_maxima)
                        <x-alert type="info">
                            Agregar Socios
                        </x-alert>
                        <h3 class="text-lg font-medium text-[#f39c12] mb-4">Lista de Socios Disponibles</h3>
                        <table class="w-full text-sm text-left">
                            <thead class="bg-gray-800 text-gray-400 text-xs uppercase">
                                <tr>
                                    <th class="px-4 py-2">Nombre</th>
                                    <th class="px-4 py-2">Créditos Disponibles</th>
                                    <th class="px-4 py-2">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableMembers as $member)
                                    <tr class="border-b border-gray-600">
                                        <td class="px-4 py-2">{{ $member->name }}</td>
                                        <td class="px-4 py-2">{{ $member->credits }}</td>
                                        <td class="px-4 py-2">
                                            <form
                                                action="{{ route('class.addMember', ['class' => $class->id, 'member' => $member->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="px-4 py-2 bg-[#f39c12] text-white rounded hover:bg-[#e67e22]">
                                                    Inscribir
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <x-alert type="alert">
                            <p>Se ha alcanzado la capacidad máxima de la clase.</p>
                        </x-alert>
                    @endif
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
