<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agregar Nueva Clase') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('admin.store-clase') }}">
                @csrf
                <!-- Nombre de la Clase -->
                <div class="mb-4">
                    <x-input-label for="nombre" :value="__('Nombre de la Clase')" />
                    <x-text-input id="nombre" class="block mt-1 w-full" type="text" name="nombre" required />
                </div>

                <!-- Selección del Profesor -->
                <div class="mb-4">
                    <x-input-label for="profesor_id" :value="__('Profesor Asignado')" />
                    <select id="profesor_id" name="profesor_id"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="" disabled selected>Seleccione un profesor...</option>
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id }}">{{ $profesor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Horario -->
                <div class="mb-4">
                    <x-input-label for="horario" :value="__('Horario')" />
                    <x-text-input id="horario" class="block mt-1 w-full" type="datetime-local" name="horario"
                        required />
                </div>

                <!-- Capacidad Máxima -->
                <div class="mb-4">
                    <x-input-label for="capacidad_maxima" :value="__('Capacidad Máxima')" />
                    <x-text-input id="capacidad_maxima" class="block mt-1 w-full" type="number" name="capacidad_maxima"
                        min="1" required />
                </div>

                <!-- Créditos Requeridos -->
                <div class="mb-4">
                    <x-input-label for="creditos_requeridos" :value="__('Créditos Requeridos')" />
                    <x-text-input id="creditos_requeridos" class="block mt-1 w-full" type="number"
                        name="creditos_requeridos" min="0" required />
                </div>

                <!-- Estado de la Clase -->
                <div class="mb-4">
                    <x-input-label for="estado" :value="__('Estado de la Clase')" />
                    <select id="estado" name="estado"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        <option value="activa">Activa</option>
                        <option value="inactiva">Inactiva</option>

                    </select>
                </div>

                <!-- Botón de Enviar -->
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.list-clases') }}">
                        <x-secondary-button class="ms-3">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                    </a>
                    <x-primary-button class="ms-3">
                        {{ __('Guardar Clase') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
