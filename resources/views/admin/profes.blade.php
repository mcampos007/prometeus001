<!-- resources/views/admin/socios.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">
            {{ __('Lista de Profesores') }}
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


    <div class="container py-12">
        <div class="content">

            <a href="{{ route('add-profes') }}"
                class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">
                {{-- <x-primary-button> --}}
                Agregar Profesor
                {{-- </x-primary-button> --}}
            </a>


            <div class="p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2  text-gray-300 text-center">Nombre</th>
                            <th class="px-4 py-2  text-gray-300 text-center">Email</th>
                            <th class="px-4 py-2  text-gray-300 text-center">Créditos</th>
                            <th class="px-4 py-2  text-gray-300 text-center">Vencimiento de Créditos</th>
                            <th class="px-4 py-2  text-gray-300 text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profes as $socio)
                            <tr class="hover:bg-gray-600">
                                <td class="px-4 py-2 border-t border-gray-700 text-left">{{ $socio->name }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $socio->email }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $socio->credits }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    {{ $socio->credit_vto ? $socio->credit_vto->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    <div class="flex justify-center space-x-4">
                                        <!-- Botón de eliminar -->
                                        <form id="delete-form-{{ $socio->id }}"
                                            action="{{ route('admin.delete-profe', $socio->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" data-id="{{ $socio->id }}"
                                                class="bg-red-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-600 transition duration-150 delete-btn"
                                                title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>

                                        <!-- Botón de editar -->
                                        <a href="{{ route('view-edit-profes', $socio->id) }}"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-blue-600 transition duration-150"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
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

</x-app-layout>
