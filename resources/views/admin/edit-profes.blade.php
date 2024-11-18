<x-app-layout>
    <x-guest-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Profesor') }}
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
                <form id="edit-profesor-form" method="POST" action="{{ route('update-profesor', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="flex items-center justify-end mt-4">
                        <x-input-label for="name" :value="__('Nombre:')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-input-label for="email" :value="__('Email:')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            value="{{ old('email', $user->email) }}" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('list-profes') }}">
                            <x-secondary-button class="ms-3">
                                {{ __('Cancelar') }}
                            </x-secondary-button>
                        </a>

                        <x-primary-button class="ms-3">
                            {{ __('Guardar Cambios') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-guest-layout>
</x-app-layout>
