<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Socios para la Clase: ') }} {{ $class->nombre }}
        </h2>
    </x-slot>

    <!-- Tabla de socios ya inscritos -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($class->class_Registrations->isEmpty())
                        <x-alert type="danger">
                            No hay socios inscriptos en esta clase.
                        </x-alert>
                    @else
                        <h3>Socios Inscriptos</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($class->class_Registrations as $member)
                                    <tr>
                                        <td>{{ $member->socio->name }}</td>
                                        <td>{{ $member->estado_inscripcion ?? (0 - $member->class_registrations_count ?? 0) }}
                                        </td>
                                        <!-- Ejemplo de estado: pendiente, presente, ausente -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Lista de socios disponibles para inscribir -->
                    <x-alert type="info">
                        Agregar Socios
                    </x-alert>
                    @if ($class->class_Registrations->count() < $class->capacidad_maxima)
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Créditos Disponibles</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($availableMembers as $member)
                                    <tr>
                                        <td>{{ $member->name }}</td>
                                        <td>{{ $member->credits }}</td>
                                        <td>
                                            <form
                                                action="{{ route('class.addMember', ['class' => $class->id, 'member' => $member->id]) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit">Inscribir</button>
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
            </div>
        </div>
    </div>


</x-app-layout>
