<!-- resources/views/generate-classes.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Generar Clases Mensuales') }}
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
            <form method="POST" action="{{ route('admin.generate-classes') }}">
                @csrf

                <!-- Selección de mes -->
                <div class="mb-4">
                    <x-input-label for="month" :value="__('Mes:')" />
                    <x-text-input id="month" class="block mt-1 w-full" type="month" name="month" required />
                </div>

                <!-- Duración de cada clase -->
                <div class="mb-4">
                    <x-input-label for="duration" :value="__('Duración de cada clase (minutos):')" />
                    <x-text-input id="duration" class="block mt-1 w-full" type="number" name="duration" value="60"
                        required />
                </div>

                <!-- Créditos requeridos -->
                <div class="mb-4">
                    <x-input-label for="credits" :value="__('Créditos Requeridos')" />
                    <x-text-input id="credits" class="block mt-1 w-full" type="number" name="credits" value="1"
                        required />
                </div>

                <!-- Capacidad máxima -->
                <div class="mb-4">
                    <x-input-label for="capacity" :value="__('Capacidad Máxima')" />
                    <x-text-input id="capacity" class="block mt-1 w-full" type="number" name="capacity" value="10"
                        required />
                </div>

                <x-primary-button class="mt-4">
                    {{ __('Generar Clases') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
