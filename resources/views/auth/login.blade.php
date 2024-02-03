@extends('layouts.app')

@section('titulo')
    Inicia sesión en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-6 md:items-center">
        <div class="md:w-6/12 p-3"> 
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen login de usuario">
        </div>
        <div class="md:w-6/12 lg:w-5/12 bg-white p-6 rounded-lg shadow-xl"> 
            <form method="POST" action="{{ route('login') }}" novalidate> 
                @csrf

                @if(session('mensaje'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                        {{ session('mensaje') }}
                    </p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        placeholder="Ingresa tu email"
                        class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" 
                        value="{{ old('email') }}"
                    />
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ $message }}
                        </p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        placeholder="Ingresa tu password"
                        class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror"
                    />
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">
                            {{ str_replace('password', 'contraseña', $message) }}
                        </p>
                    @enderror
                </div>

                <div class="mb-5 flex gap-1">
                    <input type="checkbox" name="remember"><label class="text-gray-500 text-sm">Mantener mi sesión abierta</label>
                </div>

                <input
                    type="submit"
                    value="Iniciar Sesión"
                    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"
                />

            </form>
        </div>        
    </div>


@endsection