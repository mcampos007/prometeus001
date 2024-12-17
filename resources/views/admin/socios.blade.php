<!-- resources/views/admin/socios.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">
            {{ __('Lista de Socios') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="bg-green-500 text-white px-4 py-2 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white px-4 py-2 rounded-md mb-4">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="py-12">
        <div class="content">
            <a href="{{ route('add-socios') }}"
                class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">
                Agregar Socio
            </a>

            <div class="p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-gray-300 text-center">Nombre</th>
                            <th class="px-4 py-2 text-gray-300 text-center">Email</th>
                            <th class="px-4 py-2 text-gray-300 text-center">Créditos</th>
                            <th class="px-4 py-2 text-gray-300 text-center">Vencimiento de Créditos</th>
                            <th class="px-4 py-2 text-gray-300 text-center">Acciones</th> <!-- Nueva columna -->

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($socios as $socio)
                            <tr class="hover:bg-gray-600">
                                <td class="px-4 py-2 border-t border-gray-700 text-left">{{ $socio->name }}</td>
                                <td class="px-4 py-2 border-t border-gray-700 text-left">{{ $socio->email }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $socio->credits }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    {{ $socio->credit_vto ? $socio->credit_vto->format('d/m/Y') : 'N/A' }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    <!-- Contenedor para los botones -->
                                    <div class="flex space-x-4">
                                        <!-- Botón de eliminar -->
                                        <form id="delete-form-{{ $socio->id }}"
                                            action="{{ route('admin.delete-socio', $socio->id) }}" method="POST"
                                            class="relative group inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-id="{{ $socio->id }}"
                                                class="bg-red-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-600 transition duration-150 delete-btn"
                                                title="Eliminar">
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
                                            {{-- class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700" --}}
                                            class="bg-blue-600 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-blue-700 transition duration-150 "
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
                <!-- Controles de paginación -->
                <div class="mt-4">
                    {{ $socios->links() }}
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
