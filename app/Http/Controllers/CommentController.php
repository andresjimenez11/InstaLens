<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post) {
        
        //Validate
        $this->validate($request, [
            'comentario' => 'required|max:255'
        ]);

        //Store
        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario
        ]);

        //Print a message
        return back()->with('mensaje', 'Comentario realizado correctamente');
    }
}
