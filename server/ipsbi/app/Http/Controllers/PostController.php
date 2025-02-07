<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function fetch(){
        $post = Post::select('posts.id', 'judul', 'url_isi', 'foto_post', 'id_penulis', 'username', 'id_kategori', 'tag', 'categories.nama', 'posts.created_at', 'posts.updated_at')
        ->withCount('comments')
        ->leftJoin('users', 'users.id', '=', 'posts.id_penulis')
        ->leftJoin('categories', 'categories.id', '=', 'posts.id_kategori')
        ->paginate(6);

        return response()->json($post);
    }

    public function get(Request $request){
        $post = Post::find($request->id);

        return response([$post, $post->owner->username, $post->category->nama]);
    }

    public function getPage(Request $request){
        $file = Storage::disk('posts')->get($request->url . '.html');

        return response($file);
    }

    public function create(Request $request){
        $html = $request->file('html');
        $id_cat = $request->kategori;

        $foldername = '';
        $html_filename = $html->hashName();
        $thumb_filename = 'placeholder.png';

        $hpath = Storage::disk('posts')->putFileAs($foldername, $html, $html_filename);

        if($request->hasFile('thumbnail')){
            $thumbs = $request->file('thumbnail');
            
            $thumb_filename = $thumbs->hashName();
            $tpath = Storage::disk('thumbs')->putFileAs($foldername, $thumbs, $thumb_filename);
        }

        if($request->add_kategori == 'true'){
            $cat = Category::create([
                'nama' => $request->new_kategori
            ]);

            $id_cat = $cat->id;
        }
        
        $post = Post::create([
            'judul' => $request->judul,
            'url_isi' => $html_filename,
            'foto_post' => 'https://api.ipsbi.org/public/thumbnails/' . $thumb_filename,
            'id_penulis' => $request->id,
            'id_kategori' => $id_cat,
            'tag' => $request->tag
        ]);

        if($post){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function update(Request $request){
        $post = Post::find($request->id);
        $foldername = '';
        
        $html = $request->file('html');
        $html_filename = $html->hashName();

        $hpath = Storage::disk('posts')->putFileAs($foldername, $html, $html_filename);
        Storage::disk('posts')->delete($post->url_isi);

        if($request->add_kategori == 'true'){
            $cat = Category::create([
                'nama' => $request->new_kategori
            ]);

            $post->id_kategori = $cat->id;
        }
        else{
            $post->id_kategori = $request->kategori;
        }
        
        $post->judul = $request->judul;
        $post->url_isi = $html_filename;
        $post->tag = $request->tag;
        
        if($request->hasFile('thumbnail')){
            $thumbs = $request->file('thumbnail');
            
            $thumb_filename = $thumbs->hashName();
            $tpath = Storage::disk('thumbs')->putFileAs($foldername, $thumbs, $thumb_filename);

            if($post->foto_post != 'https://api.ipsbi.org/public/thumbnails/placeholder.png'){
                Storage::disk('thumbs')->delete(explode("thumbnails/", $post->foto_post)[1]);
            }

            $post->foto_post = 'https://api.ipsbi.org/public/thumbnails/' . $thumb_filename;
        }

        $post->save();
        
        if($post){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function delete(Request $request){
        $post = Post::find($request->id);

        Storage::disk('posts')->delete($post->url_isi);

        if($post->foto_post != 'https://api.ipsbi.org/public/thumbnails/placeholder.png'){
            Storage::disk('thumbs')->delete(explode("thumbnails/", $post->foto_post)[1]);
        }

        $post->comments()->delete();
        $post->delete();

        if($post){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }
}
