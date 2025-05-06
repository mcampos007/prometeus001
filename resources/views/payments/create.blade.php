@extends('layouts.webpage')

@section('titulo', 'Registrar Pago')

@section('contenido')
    <div class="container">
        <h2 class="text-3xl text-[#f39c12] mb-4">Registrar un nuevo pago</h2>

        <div class="flex justify-center py-4">


            <div class="section max-w-xl mx-auto transition-opacity duration-500 ease-in-out animate-fadeIn">
                <form action="{{ route('payments.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf

                    {{-- Socio --}}
                    <div>
                        <label for="user_id" class="block mb-1 text-white">Socio</label>
                        <select name="user_id"
                            class="form-control w-full p-2 rounded bg-[#111] text-black @error('user_id') border-red-500 @enderror"
                            required>
                            <option value="">Seleccione un socio</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->credits }} créditos)
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Monto --}}
                    <div>
                        <label for="amount" class="block mb-1 text-white">Monto</label>
                        <input type="number" name="amount" step="0.01" value="{{ old('amount') }}"
                            class="form-control w-full p-2 rounded bg-[#111] text-black @error('amount') border-red-500 @enderror"
                            required>
                        @error('amount')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Créditos --}}
                    <div>
                        <label for="credits" class="block mb-1 text-white">Créditos otorgados</label>
                        <input type="number" name="credits" value="{{ old('credits') }}"
                            class="form-control w-full p-2 rounded bg-[#111] text-black @error('credits') border-red-500 @enderror"
                            min="1" required>
                        @error('credits')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fecha de pago --}}
                    <div>
                        <label for="payment_date" class="block mb-1 text-white">Fecha de pago</label>
                        <input type="date" name="payment_date" value="{{ old('payment_date') }}"
                            class="form-control w-full p-2 rounded bg-[#111] text-black @error('payment_date') border-red-500 @enderror"
                            required>
                        @error('payment_date')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Vencimiento --}}
                    <div>
                        <label for="expires_at" class="block mb-1 text-white">Vence el</label>
                        <input type="date" name="expires_at" value="{{ old('expires_at') }}"
                            class="form-control w-full p-2 rounded bg-[#111] text-black @error('expires_at') border-red-500 @enderror"
                            required>
                        @error('expires_at')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Método --}}
                    <div>
                        <label for="method" class="block mb-1 text-white">Método de pago</label>
                        <input type="text" name="method" value="{{ old('method') }}"
                            class="form-control w-full p-2 rounded bg-[#111] text-black">
                    </div>

                    {{-- Notas --}}
                    <div>
                        <label for="notes" class="block mb-1 text-white">Observaciones</label>
                        <textarea name="notes" class="form-control w-full p-2 rounded bg-[#111] text-black" rows="3">{{ old('notes') }}</textarea>
                    </div>

                    {{-- Botón --}}
                    <button type="submit"
                        class="bg-[#f39c12] hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded transition">
                        Guardar
                    </button>
                </form>
            </div>
        </div>




    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeIn {
            animation: fadeIn 0.5s ease-in-out forwards;
        }
    </style>
@endsection
