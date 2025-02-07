<?php

namespace App\Http\Controllers;

use App\Models\Banner;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function fetch(Request $request){
        $banners = Banner::select('id', 'title', 'link', 'created_at');

        if($request->mode == 'all'){
            $banners = $banners->get();
        }
        else{
            $banners = $banners->paginate(6);
        }

        return response()->json($banners);
    }

    public function create(Request $request){
        $banner = $request->file('banner');

        $foldername = '';
        $banner_filename = $banner->hashName();

        $bpath = Storage::disk('banners')->putFileAs($foldername, $banner, $banner_filename);
        $proc = Banner::create([
            'title' => $request->title,
            'link' => 'https://api.ipsbi.org/public/banners/' . $banner_filename
        ]);

        if($proc){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function delete(Request $request){
        $banner = Banner::find($request->id);

        Storage::disk('banners')->delete(explode("banners/", $banner->link)[1]);
        $banner->delete();

        if($banner){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }   
}
