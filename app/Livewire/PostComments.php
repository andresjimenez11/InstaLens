<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comentario;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class PostComments extends Component
{   
    public $post; 
    public $user;
    public $comentario;
    public EloquentCollection $comentarios;

    public function mount($post){
        
        $this->post = $post;
        $this->user = auth()->user();
        $this->comentarios = $post->comentarios;
 
    }

    public function comment(){
        //Validar 
        $this->validate([
            'comentario' => 'required|max:255'
        ]);

        //Almacenar
        $newComment = Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comentario
        ]);

        //Imprimir un mensaje
        $this->comentarios->push($newComment);
        $this->reset('comentario');

    }

    public function render()
    {
        return view('livewire.post-comments');
    }
}
