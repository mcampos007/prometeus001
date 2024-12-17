<x-app-layout>
    <x-slot name="header">

        <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">
            {{ __('Asignar Créditos a Socio') }}
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
            {{-- -{{ $socio->id }} --}}
            <form id="addCredit-form-{{ $select_socio_id }}" method="POST" action="{{ route('admin.add-credits') }}"
                class="relative group inline">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-[#f39c12] ">
                        Seleccione Socio
                    </label>
                    <select id="user_id" name="user_id" required class=" mt-2  bg-gray-700">
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
                    <label for="credits" class="block text-sm font-medium text-[#f39c12] ">
                        Créditos a asignar
                    </label>
                    <input type="number" id="credits" name="credits" required min="1"
                        class="input-primary mt-2  bg-gray-700">
                </div>

                <div class="flex justify-center space-x-4">
                    <!-- Botón para enviar el formulario -->
                    <button type="submit"
                        class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">
                        Asignar Créditos
                    </button>

                    <!-- Botón para redirigir al dashboard -->
                    <a href="{{ route('list-socios') }}"
                        class="inline-block px-6 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-lg hover:bg-gray-600">
                        {{ __('Cancelar') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
