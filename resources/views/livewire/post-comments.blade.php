<div>
    @auth
        <!-- <p class="text-xl font-bold text-center mb-4">  Agrega un nuevo comentario  </p> -->
        @if (session('mensaje'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{ session('mensaje') }}
            </div>
        @endif
    
        <br>
    
        <label for="comentario"  class="mb-2 block uppercase text-gray-500 font-bold">
            Añade un comentario
        </label>
        <textarea wire:model="comentario" wire:keydown.enter="comment()"
            id="comentario"
            name="comentario"
            type="text"
            placeholder="Agrega un comentario"
            class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror"
        >{{ $comentario }}</textarea>
    
        @error('comentario')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2">{{ $message }}</p>
        @enderror
        <hr/>
        <button wire:click="comment" class="bg-sky-700 hover:bg-sky-700 transition-colors cursor-pointer font-bold w-full p-3 text-white rounded-lg">
            Comentar
        </button>
    
    
    @endauth
    
    <div class="bg-white shadow mb-5 max-h-[30rem]  overflow-y-scroll mt-10">
        @if ($comentarios->count())
        
            @foreach ($comentarios->reverse() as $comentario)
        
                <div class="p-5 border-gray-300 border-b">
                    <a class= "font-bold" href="{{ route('posts.index', $comentario->user) }}">
                        {{ $comentario->user->username }}
                    </a>
                    <p>{{ $comentario->comentario }}</p>
                    <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        @else
            <p class="p-10 text-center ">No hay comentarios aún</p>
        @endif
    </div>
</div>

