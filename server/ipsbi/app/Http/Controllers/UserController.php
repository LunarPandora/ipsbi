<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function fetch(){
        $users = User::select('id_user', 'username', 'role', 'email', 'foto_profil')
        ->withCount('posts')
        ->paginate(5);

        return response()->json($users);
    }

    public function create(Request $request){
        $foldername = '';
        $pic_filename = 'placeholder.png';

        if($request->hasFile('profile')){
            $pic = $request->file('profile');
            
            $pic_filename = $pic->hashName();
            $ppath = Storage::disk('profiles')->putFileAs($foldername, $pic, $pic_filename);
        }
        
        $acc = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'foto_profil' => 'https://api.ipsbi.org/public/profiles/' . $pic_filename,
            'role' => 'admin',
        ]);

        if($acc){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function update(Request $request){
        $acc = User::find($request->id);
        $foldername = '';

        $acc->username = $request->username;
        $acc->email = $request->email;

        if($request->password != ''){
            $acc->password = Hash::make($request->password);
        }

        if($request->hasFile('profile')){
            $pic = $request->file('profile');
            
            if($acc->foto_profil != 'https://api.ipsbi.org/public/profiles/placeholder.png'){
                Storage::disk('profiles')->delete(explode("profiles/", $acc->foto_profil)[1]);
            }

            $pic_filename = $pic->hashName();
            $ppath = Storage::disk('profiles')->putFileAs($foldername, $thumbs, $pic_filename);

            $acc->foto_profil = 'https://api.ipsbi.org/public/profiles/' . $pic_filename;
        }

        $acc->save();
        
        if($acc){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function delete(Request $request){
        $acc = User::find($request->id);

        if($acc->foto_profil != 'https://api.ipsbi.org/public/profiles/placeholder.png'){
            Storage::disk('profiles')->delete(explode("profiles/", $acc->foto_profil)[1]);
        }

        $acc->delete();

        if($acc){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }
}