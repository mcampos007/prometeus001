<!-- resources/views/admin/socios.blade.php -->

<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Profesores') }}
        </h2> --}}
        <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">
            {{ __('Lista de Profesores') }}
        </h2>

        {{-- <h2 class="font-semibold text-xl text-primary-500 dark:text-primary-300 leading-tight">
            {{ __('Lista de Profesores') }}
        </h2> --}}

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
    <div class="flex justify-center py-4">
        <a href="{{ route('add-profes') }}"
            class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">
            {{-- <x-primary-button> --}}
            Agregar Profesor
            {{-- </x-primary-button> --}}
        </a>

    </div>
    {{-- <div class="py-12">
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
                            @foreach ($profes as $socio)
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
                                                    Eliminar Profesor
                                                </span>
                                            </form>

                                            <!-- Botón de agregar crédito -->
                                            <a href="{{ route('view-edit-profes', $socio->id) }}"
                                                class="relative group px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
                                                title="Editar datos del Profesor">
                                                <i class="fas fa-edit"></i> <!-- Ícono de agregar crédito -->
                                                <!-- Tooltip de Agregar Crédito -->
                                                <span
                                                    class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 text-white bg-black rounded py-1 px-2 text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                                                    Editar Profesor
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
    </div> --}}
    {{--  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full table-auto border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-200 dark:bg-gray-700">
                            <tr>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Nombre</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Email</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Créditos</th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Vencimiento de Créditos
                                </th>
                                <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-300">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($profes as $socio)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <td class="px-4 py-2 border-t border-gray-300 dark:border-gray-700">
                                        {{ $socio->name }}</td>
                                    <td class="px-4 py-2 border-t border-gray-300 dark:border-gray-700">
                                        {{ $socio->email }}</td>
                                    <td class="px-4 py-2 border-t border-gray-300 dark:border-gray-700">
                                        {{ $socio->credits }}</td>
                                    <td class="px-4 py-2 border-t border-gray-300 dark:border-gray-700">
                                        {{ $socio->credit_vto ? $socio->credit_vto->format('d/m/Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 py-2 border-t border-gray-300 dark:border-gray-700">
                                        <div class="flex space-x-4">
                                            <!-- Botón de eliminar -->
                                            <form action="{{ route('admin.delete-socio', $socio->id) }}" method="POST"
                                                class="relative group inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 bg-red-500 text-white rounded-md font-semibold text-xs hover:bg-red-600 transition duration-150 ease-in-out"
                                                    title="Eliminar Socio">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>

                                            <!-- Botón de editar -->
                                            <a href="{{ route('view-edit-profes', $socio->id) }}"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-md font-semibold text-xs hover:bg-blue-600 transition duration-150 ease-in-out"
                                                title="Editar datos del Profesor">
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
    </div> --}}

    <div class="container py-12">
        <div class="content">
            <div class="p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-gray-300">Nombre</th>
                            <th class="px-4 py-2 text-left text-gray-300">Email</th>
                            <th class="px-4 py-2 text-left text-gray-300">Créditos</th>
                            <th class="px-4 py-2 text-left text-gray-300">Vencimiento de Créditos</th>
                            <th class="px-4 py-2 text-left text-gray-300">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profes as $socio)
                            <tr class="hover:bg-gray-600">
                                <td class="px-4 py-2 border-t border-gray-700">{{ $socio->name }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $socio->email }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $socio->credits }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    {{ $socio->credit_vto ? $socio->credit_vto->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    <div class="flex justify-center space-x-4">
                                        <!-- Botón de eliminar -->
                                        <form action="{{ route('admin.delete-profe', $socio->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-600 transition duration-150">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button>
                                        </form>

                                        <!-- Botón de editar -->
                                        <a href="{{ route('view-edit-profes', $socio->id) }}"
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-blue-600 transition duration-150">
                                            <i class="fas fa-edit"></i> Editar
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
