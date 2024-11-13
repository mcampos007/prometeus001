<!-- resources/views/admin/socios.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Socios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Nombre</th>
                                <th class="px-4 py-2 text-left">Email</th>
                                <th class="px-4 py-2 text-left">Créditos</th>
                                <th class="px-4 py-2 text-left">Vencimiento de Créditos</th>
                                <th class="px-4 py-2 text-left">Acciones</th> <!-- Nueva columna -->

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($socios as $socio)
                                <tr>
                                    <td class="px-4 py-2">{{ $socio->name }}</td>
                                    <td class="px-4 py-2">{{ $socio->email }}</td>
                                    <td class="px-4 py-2">{{ $socio->credits }}</td>
                                    <td class="px-4 py-2">
                                        {{ $socio->credit_vto ? $socio->credit_vto->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                        <!-- Contenedor para los botones -->
                                        <div class="flex space-x-4">
                                            <!-- Botón de eliminar -->
                                            <form action="{{ route('admin.delete-socio', $socio->id) }}" method="POST"
                                                class="relative group inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                                                    title="Eliminar Socio">
                                                    <i class="fas fa-trash-alt"></i> <!-- Ícono de papelera -->
                                                </button>
                                                <!-- Tooltip de Eliminar -->
                                                <span
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                                    Eliminar Socio
                                                </span>
                                            </form>

                                            <!-- Botón de agregar crédito -->
                                            <a href="{{ route('admin.show-add-credits-socio-form', $socio->id) }}"
                                                class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                                title="Agregar Créditos al Socio">
                                                <i class="fas fa-money-bill-wave"></i> <!-- Ícono de agregar crédito -->
                                                <!-- Tooltip de Agregar Crédito -->
                                                <span
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                                    Agregar Créditos al Socio
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
