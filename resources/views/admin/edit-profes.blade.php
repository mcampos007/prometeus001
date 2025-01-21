<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center">
            {{ __('Editar Profesor') }}
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
        <div class="form-container">
            <form id="edit-profesor-form" method="POST" action="{{ route('update-profesor', $user->id) }}">
                @csrf
                @method('PUT')
                {{-- REgistro del Dni --}}
                <div class="mb-6">
                    <label for="dni" class="block text-sm font-medium text-[#f39c12] ">
                        {{ __('DNI') }}
                    </label>
                    <input id="dni" class="input-primary mt-2 bg-gray-700" type="text" name="dni"
                        value="{{ old('dni', $user->dni) }}" required autofocus>
                    @error('dni')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium  text-[#f39c12] ">
                        {{--  --}}
                        {{ __('Nombre') }}
                    </label>
                    <input id="name" class="input-primary mt-2 bg-gray-700" type="text" name="name"
                        value="{{ old('name', $user->name) }}" required autofocus autocomplete="username" />
                    @error('name')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-[#f39c12]"> {{ __('Email') }}
                    </label>
                    <input id="email" class="input-primary mt-2 bg-gray-700" type="email" name="email"
                        value="{{ old('email', $user->email) }}" required autofocus autocomplete="username" />
                    @error('email')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-center space-x-4">
                    <a href="{{ route('list-profes') }}"
                        class="inline-block px-6 py-2 text-sm font-medium text-gray-300 bg-gray-700 border-gray-600 rounded-lg hover:bg-gray-600">
                        {{ __('Cancelar') }}
                    </a>

                    <button type="submit"
                        class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold
                        hover:bg-[#e67e22]">
                        {{ __('Guardar Cambios') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
