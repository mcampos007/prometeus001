<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Días de Trabajo</h2>
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
    {{-- <div class="flex justify-center py-4">
        <a href="{{ route('admin.add-clases') }}">
            <x-primary-button>
                Agregar Día
            </x-primary-button>
        </a>
    </div> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('work_days.create') }}" class="btn btn-primary mb-4">
                <x-primary-button>

                    Crear Nuevo Día de Trabajo
                </x-primary-button>
            </a>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Activo</th>
                            <th>Horario de Mañana</th>
                            <th>Horario de Tarde</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workDays as $workDay)
                            <tr>
                                <td>{{ $workDay->day }}</td>
                                <td>{{ $workDay->active ? 'Sí' : 'No' }}</td>
                                <td>{{ $workDay->morning_start }} - {{ $workDay->morning_end }}</td>
                                <td>{{ $workDay->afternoon_start }} - {{ $workDay->afternoon_end }}</td>
                                <td>
                                    <a href="{{ route('work_days.edit', $workDay->id) }}"><i class="fas fa-edit"
                                            title="Editar"></i></a>
                                    <form action="{{ route('work_days.destroy', $workDay->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Eliminar"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
