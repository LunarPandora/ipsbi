<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    public function fetch(){
        $form = Form::paginate(5);

        return response($form);
    }

    public function get(Request $request){
        $form = Form::find($request->id);

        return response($form);
    }

    public function create(Request $request){
        $form = Form::create([
            "title" => $request->title,
            "desc" => $request->desc,
            "link" => $request->link
        ]);

        if($form){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function update(Request $request){
        $form = Form::find($request->id);

        $form->title = $request->title;
        $form->desc = $request->desc;
        $form->link = $request->link;

        $form->save();

        if($form){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }

    public function delete(Request $request){
        $form = Form::find($request->id);
        $form->delete();

        if($form){
            return response('Success!');
        }
        else{
            return response('Error!');
        }
    }
}
