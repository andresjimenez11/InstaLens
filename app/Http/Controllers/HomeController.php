<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct() {
        
        // Controlador protegido, debe estar iniciada sesión
        $this->middleware('auth');
    }

    public function __invoke(){
        
        // Obtener a quienes seguimos con eloquent
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);
        
        return view('home', [
            'posts' => $posts
        ]);
    }
}
