<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;">Días de Trabajo</h2>
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
        <div class="content">
            {{-- <div class="flex justify-center py-4"> --}}
            <a href="{{ route('work_days.create') }}"
                class="ml-3 bg-[#f39c12] text-white px-6 py-2 rounded-lg font-bold hover:bg-[#e67e22]">

                Crear Nuevo Día de Trabajo

            </a>

            {{-- </div> --}}
            <div class="p-6">
                <table class="min-w-full table-auto border-collapse border border-gray-70">
                    <thead class="bg-gray-700">
                        <tr class="hover:bg-gray-600">
                            <th class="px-4 py-2 text-center text-gray-300">Día</th>
                            <th class="px-4 py-2 text-center text-gray-300">Activo</th>
                            <th class="px-4 py-2 text-center text-gray-300">Horario de Mañana</th>
                            <th class="px-4 py-2 text-center text-gray-300">Horario de Tarde</th>
                            <th class="px-4 py-2 text-center text-gray-300">Profesor</th>
                            <th class="px-4 py-2 text-center text-gray-300">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workDays as $workDay)
                            <tr class="hover:bg-gray-600">
                                <td class="px-4 py-2 border-t border-gray-700 text-left">{{ $workDay->day }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $workDay->active ? 'Sí' : 'No' }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $workDay->morning_start }} -
                                    {{ $workDay->morning_end }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">{{ $workDay->afternoon_start }} -
                                    {{ $workDay->afternoon_end }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">
                                    {{ $workDay->user->name ?? 'No asignado' }}</td>
                                <td class="px-4 py-2 border-t border-gray-700">

                                    <div class="flex space-x-2">

                                        <a href="{{ route('work_days.edit', $workDay->id) }}""
                                            class="bg-blue-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-blue-600 transition duration-150"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- <a href="{{ route('work_days.edit', $workDay->id) }}"
                                            class="bg-blue-500 text-white px-5 py-2 rounded-md font-semibold text-xs hover:bg-blue-600 transition duration-150">
                                            <i class="fas fa-edit"></i> Editar
                                        </a> --}}


                                        <form id="delete-form-{{ $workDay->id }}"
                                            action="{{ route('work_days.destroy', $workDay->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            {{-- <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded-md font-bold text-xs hover:bg-red-600 transition duration-150">
                                                <i class="fas fa-trash-alt"></i> Eliminar
                                            </button> --}}

                                            <button type="button" data-id="{{ $workDay->id }}"
                                                class="bg-red-500 text-white px-4 py-2 rounded-md text-xs hover:bg-red-600 transition duration-150 delete-btn"
                                                title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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
