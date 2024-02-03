@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2 px-3 md:p-0">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
            <div class="py-1 px-3 flex items-center gap-2">
            
                @auth

                    <livewire:like-post :post="$post" />
                 
                @endauth
                
            </div>

            <div class="py-1 px-3">
                <p class="mb-5">
                    {{ $post->descripcion }}
                </p>
                <a href=" {{ route('posts.index', $user) }} "class="font-bold">{{ $post->user->username }}</a>
                <p class="text-sm text-gray-500">
                    {{ $post->created_at->diffForHumans() }}
                </p>
                @auth
                    @if($post->user_id === auth()->user()->id)
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @method('DELETE') <!-- Método spoofing --> 
                            @csrf
                            <input 
                            type="submit"
                            value="Eliminar publicación"
                            class="bg-red-500 hover:bg-red-600 p-2 rounded text-white font-bold mt-4 cursor-pointer"
                            >
                        </form>
                    @endif
                @endauth
            </div>
        </div>
        <div class="md:w-1/2 px-5 py-0">
            <div class="shadow bg-white p-5 my-10 md:m-0">
                <livewire:post-comments :post="$post" : user="$user" />
            </div>
        </div>
    </div>
@endsection