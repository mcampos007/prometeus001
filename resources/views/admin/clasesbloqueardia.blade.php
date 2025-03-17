<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#f39c12] leading-tight text-center">
            {{ __('Bloquear las Clases de un día') }}
        </h2>
    </x-slot>
    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-3 rounded-md mb-4">
            {{ session('error') }}
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
        <div class="content">
            <div class="flex justify-center py-4">
                <div class="flex justify-center py-4">

                    <form action="{{ route('admin.bloquear-day-clase') }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')

                        <label for="fecha" class="mr-2 font-bold">Selecciona una fecha:</label>
                        <input type="date" name="fecha" id="fecha" required
                            class="border rounded px-3 py-2 mr-3 text-black"
                            value="{{ \Carbon\Carbon::parse(request('fecha', now()->format('Y-m-d')))->format('Y-m-d') }}">

                        <button class="ml-3 bg-red-500 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-900"
                            type="submit">
                            <i class="fas fa-lock"></i><span> Bloquear Todo el Día</span>
                        </button>
                    </form>



                </div>

            </div>
        </div>
    </div>

</x-app-layout>
