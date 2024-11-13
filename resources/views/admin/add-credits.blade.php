<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asignar Créditos a Socio') }}
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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form id="credit-form" method="POST" action="{{ route('admin.add-credits') }}">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Seleccione Socio
                    </label>
                    <select id="user_id" name="user_id" required
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        {{-- <option value="" disabled selected>Seleccione un socio...</option> --}}
                        <option value="" disabled {{ !$select_socio_id ? 'selected' : '' }}>Seleccione un socio...
                        </option>
                        {{-- @foreach ($socios as $socio)
                            <option value="{{ $socio->id }}">{{ $socio->name }} - {{ $socio->email }}</option>
                        @endforeach --}}
                        @foreach ($socios as $socio)
                            <option value="{{ $socio->id }}" {{ $socio->id == $select_socio_id ? 'selected' : '' }}>
                                {{ $socio->name }} - {{ $socio->email }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="credits" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                        Créditos a asignar
                    </label>
                    <input type="number" id="credits" name="credits" required min="1"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                </div>

                <div class="flex justify-end space-x-2">
                    <!-- Botón para enviar el formulario -->
                    <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Asignar Créditos
                    </button>

                    <!-- Botón para redirigir al dashboard -->
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 text-white bg-gray-600 rounded-md hover:bg-gray-700">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
