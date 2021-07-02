<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('index');
    }

    public function save_post(Request $request){
        // dd($request->all());
        $post=new Post;
        // $post->name=$request->input('name');

        if($request->hasFile('image')){
            $completeFileName=$request->file('image')->getClientOriginalName();
            // dd($completeFileName);
            $fileNameOnly=pathinfo($completeFileName,PATHINFO_FILENAME);
            $extenshion=$request->file('image')->getClientOriginalExtension();
            // dd($extenshion);
            $comPic=str_replace('','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extenshion;
            // dd($comPic);
            $path=$request->file('image')->storeAs('public/posts',$comPic);
            $post->image=$comPic;
        }
        $post->name=$request->input('name');
        $post->description=$request->input('description');
        if($post->save()){
            return['status'=>true,'message'=>'Post saved successfully'];
        }
        else{
            return['status'=>false,'message'=>'Something went wrong'];
        }
    }

    public function get_posts(){
        $posts=Post::all();
        echo json_encode($posts);
    }
    public function edit($id){
        $post=Post::find($id);
        return view('edit' ,compact('post'));
    }

    public function update(Request $request , $id){
        $post=Post::find($id);
        if($request->hasFile('image')){
            $completeFileName=$request->file('image')->getClientOriginalName();
            // dd($completeFileName);
            $fileNameOnly=pathinfo($completeFileName,PATHINFO_FILENAME);
            $extenshion=$request->file('image')->getClientOriginalExtension();
            // dd($extenshion);
            $comPic=str_replace('','_',$fileNameOnly).'-'.rand().'_'.time().'.'.$extenshion;
            // dd($comPic);
            $path=$request->file('image')->storeAs('public/posts',$comPic);
            $post->image=$comPic;
        }
        $post->name=$request->input('name');
        $post->description=$request->input('description');
        if($post->save()){
            return['status'=>true,'message'=>'Post Updated successfully'];
        }
        else{
            return['status'=>false,'message'=>'Something went wrong'];
        }
    }

    public function destroy($id){
        $post=Post::findOrFail($id);

        if($post->delete()){
            return response(['status'=>true,'message'=>'Post Deleted Successfully']);
        }else{
            return response(['status'=>false,'message'=>'Something went wrong']);
        }
    }
}
