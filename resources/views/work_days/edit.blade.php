<!-- resources/views/work_days/edit.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center">
            {{ __('Editar Día de Trabajo') }}
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

            <form method="POST" action="{{ route('work_days.update', $workDay->id) }}">
                @csrf
                @method('PUT')

                <!-- Día -->
                <div class="mb-4">

                    <label for="name" class="block text-sm font-medium  text-[#f39c12] ">
                        {{--  --}}
                        {{ __('Día de la Semana') }}
                    </label>

                    <select id="day" name="day" class="block w-full input-primary mt-2  bg-gray-700 rounded">
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
                    <label for="name" class="block text-sm font-medium  text-[#f39c12] ">
                        {{ __('¿Activo?') }}
                    </label>
                    <input id="active" name="active" type="checkbox" value="1"
                        {{ $workDay->active ? 'checked' : '' }} class="rounded border-gray-300 bg-gray-700" />
                </div>

                <!-- Horarios -->
                <div class="mb-4">
                    <label for="morning_start" class= "block text-sm font-medium  text-[#f39c12] ">
                        {{ __('Hora de inicio (Mañana)') }}
                    </label>
                    <x-text-input id="morning_start" name="morning_start" type="time"
                        class="block mt-1 w-full bg-gray-700" value="{{ $workDay->morning_start }}" />
                    <x-input-error :messages="$errors->get('morning_start')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="morning_end" class= "block text-sm font-medium  text-[#f39c12] ">
                        {{ __('Hora de fin (Mañana)') }}
                    </label>

                    <x-text-input id="morning_end" name="morning_end" type="time"
                        class="block mt-1 w-full bg-gray-700" value="{{ $workDay->morning_end }}" />
                    <x-input-error :messages="$errors->get('morning_end')" class="mt-2" />
                </div>

                <div class="mb-4">
                    <label for="afternoon_start" class= "block text-sm font-medium  text-[#f39c12] ">
                        {{ __('Hora de inicio (Tarde)') }}
                    </label>
                    <x-text-input id="afternoon_start" name="afternoon_start" type="time"
                        class="block mt-1 w-full bg-gray-700" value="{{ $workDay->afternoon_start }}" />
                    <x-input-error :messages="$errors->get('afternoon_start')" class="mt-2" />
                </div>
                <div class="mb-4">
                    <label for="afternoon_end" class= "block text-sm font-medium  text-[#f39c12] ">
                        {{ __('Hora de fin (Tarde)') }}
                    </label>
                    <x-text-input id="afternoon_end" name="afternoon_end" type="time"
                        class="block mt-1 w-full bg-gray-700" value="{{ $workDay->afternoon_end }}" />
                    <x-input-error :messages="$errors->get('afternoon_end')" class="mt-2" />
                </div>

                <!-- Profesor -->
                <div class="mb-4">
                    <label for="user_id" class= "block text-sm font-medium  text-[#f39c12] ">
                        {{ __('Profesor Asignado') }}
                    </label>
                    <select id="user_id" name="user_id" class="block mt-1 w-full bg-gray-700">
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

                    <button type="submit"
                        class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">
                        {{ __('Actualizar Día de Trabajo') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
