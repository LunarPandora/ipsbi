<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function get(Request $request){
        $data = Comment::where('id_post', $request->idp)
                ->orderBy('created_at')
                ->paginate(5);

        return response()->json($data); 
    }

    public function search(Request $request){
        $data = Comment::where('isi_komentar', "LIKE", "%" . $request->search_query . "%")
                        ->orWhere('nama', "LIKE", "%" . $request->search_query . "%")
                        ->orderBy('created_at')
                        ->paginate(5);

        return response()->json($data);
    }

    public function fetch(){
        $data = Comment::select('comments.id_komentar', 'posts.judul', 'isi_komentar', 'nama', 'email', 
                                'comments.created_at')
                        ->with(['posts'])
                        ->paginate(6);

        return response()->json($data);
    }

    public function create(Request $request){
        // Jangan lupa tambahkan validate untuk memastikan isi komentar tidak menginclude karakter special - W
        $new_com = Comment::create([
            'id_post' => $request->idp,
            'isi_komentar' => $request->komentar,
            'nama' => $request->nama,
            'email' => $request->email
        ]);

        if($new_com){
            return response('Success!');
        }
        else{
            return response('Failed!');
        }
    }

    public function delete(Request $request){
        $rem_com = Comment::find($request->id)->delete();

        if($rem_com){
            return response('Success!');
        }
        else{
            return response('Failed!');
        }
    }
}
