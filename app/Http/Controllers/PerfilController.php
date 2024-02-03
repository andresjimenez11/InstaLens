<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{   
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(User $user){
        return view('perfil.index', [
            'user' => $user
        ]);
    }

    public function store(Request $request) {

        // Modify the request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required','string','min:3','max:20','unique:users,username,' . auth()->user()->id, 'not_in:editar-perfil'],
            'email' => ['required','unique:users,email,' . auth()->user()->id, 'email','max:60']
        ]);

        if($request->imagen) {
            $image = $request->file('imagen');

            $nameImage = Str::uuid() . "." . $image->extension();

            $imageServe = Image::make($image);
            $imageServe->fit(1000, 1000);

            $imagePath = public_path('profiles') . '/' . $nameImage;

            $imageServe->save($imagePath);
        }

        // Save changes
        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->email = $request->email;

        // Get the previous image and delete it if it exists
        $imagePrevious = $user->imagen;
        if ($imagePrevious && file_exists(public_path('profiles') . '/' . $imagePrevious)) {
            unlink(public_path('profiles') . '/' . $imagePrevious);
        }

        // If there is no image, search in the DB, if not in the DB assign null
        $user->imagen = $nameImage ?? auth()->user()->imagen ?? null;
        $user->save();

        // Validate new password
        if($request->oldpassword || $request->password) {
            $this->validate($request, [
                'password' => 'required|confirmed',
            ]);
            
            if(Hash::check($request->oldpassword, auth()->user()->password)) {
                $user->password = Hash::make($request->password) ?? auth()->user()->password;
                $user->save();
            } else {
                return back()->with('mensaje', 'La contraseña actual no coincide');
            }
        }

        // Redirect user, with new username
        return redirect()->route('posts.index', $user->username);
        
    }
}
