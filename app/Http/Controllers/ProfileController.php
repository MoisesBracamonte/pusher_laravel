<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    // Edit user 
    public function edit(){
      return view('profile');
    }
    public function update(Request $request){
        $request->validate([
            'name' => 'min:4',
            'email' => 'email|min:4'
        ]);
        $user = Auth::user();
        if($request->hasFile('img_perfil')){
            $path = Storage::disk('public')->put('image',$request->file('img_perfil'));
            $request['image_perfil'] = asset($path);
        }
        if($request->password){
            $request['password'] = bcrypt($request->password);
            $user->fill($request->all())->save();
        }else{
            $user->fill($request->except('password'))->save();
        }
        return back()->with('edit_user','Se edito con éxito el usuario');
        
        
    }
}
