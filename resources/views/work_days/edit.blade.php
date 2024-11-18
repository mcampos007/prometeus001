<!-- resources/views/work_days/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Día de Trabajo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
            <form method="POST" action="{{ route('work_days.update', $workDay->id) }}">
                @csrf
                @method('PUT')

                <!-- Día -->
                <div class="mb-4">
                    <x-input-label for="day" :value="__('Día de la Semana')" />
                    <select id="day" name="day" class="block mt-1 w-full">
                        <option value="lunes" {{ $workDay->day == 'monday' ? 'selected' : '' }}>Lunes</option>
                        <option value="martes" {{ $workDay->day == 'tuesday' ? 'selected' : '' }}>Martes</option>
                        <option value="miercoles" {{ $workDay->day == 'wednesday' ? 'selected' : '' }}>Miércoles
                        </option>
                        <option value="jueves" {{ $workDay->day == 'thursday' ? 'selected' : '' }}>Jueves</option>
                        <option value="viernes" {{ $workDay->day == 'friday' ? 'selected' : '' }}>Viernes</option>
                        <option value="sabado" {{ $workDay->day == 'saturday' ? 'selected' : '' }}>Sábado</option>
                        <option value="domingo" {{ $workDay->day == 'sunday' ? 'selected' : '' }}>Domingo</option>
                    </select>
                    <x-input-error :messages="$errors->get('day')" class="mt-2" />
                </div>

                <!-- Estado Activo -->
                <div class="mb-4">
                    <x-input-label for="active" :value="__('¿Activo?')" />
                    <input id="active" name="active" type="checkbox" value="1"
                        {{ $workDay->active ? 'checked' : '' }} class="rounded border-gray-300" />
                </div>

                <!-- Horarios -->
                <div class="mb-4">
                    <x-input-label for="morning_start" :value="__('Hora de inicio (Mañana)')" />
                    <x-text-input id="morning_start" name="morning_start" type="time" class="block mt-1 w-full"
                        value="{{ $workDay->morning_start }}" />
                    <x-input-error :messages="$errors->get('morning_start')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="morning_end" :value="__('Hora de fin (Mañana)')" />
                    <x-text-input id="morning_end" name="morning_end" type="time" class="block mt-1 w-full"
                        value="{{ $workDay->morning_end }}" />
                    <x-input-error :messages="$errors->get('morning_end')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="afternoon_start" :value="__('Hora de inicio (Tarde)')" />
                    <x-text-input id="afternoon_start" name="afternoon_start" type="time" class="block mt-1 w-full"
                        value="{{ $workDay->afternoon_start }}" />
                    <x-input-error :messages="$errors->get('afternoon_start')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <x-input-label for="afternoon_end" :value="__('Hora de fin (Tarde)')" />
                    <x-text-input id="afternoon_end" name="afternoon_end" type="time" class="block mt-1 w-full"
                        value="{{ $workDay->afternoon_end }}" />
                    <x-input-error :messages="$errors->get('afternoon_end')" class="mt-2" />
                </div>

                <!-- Profesor -->
                <div class="mb-4">
                    <x-input-label for="user_id" :value="__('Profesor Asignado')" />
                    <select id="user_id" name="user_id" class="block mt-1 w-full">
                        @foreach ($profesores as $profesor)
                            <option value="{{ $profesor->id }}"
                                {{ $workDay->user_id == $profesor->id ? 'selected' : '' }}>
                                {{ $profesor->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-end mt-4">
                    <a href="{{ route('work_days.index') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 mr-3">
                        {{ __('Cancelar') }}
                    </a>
                    <x-primary-button>
                        {{ __('Actualizar Día de Trabajo') }}
                    </x-primary-button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
