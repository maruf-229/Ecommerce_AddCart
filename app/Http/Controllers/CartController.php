<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SebastianBergmann\Environment\Console;

//use Cart;

class CartController extends Controller
{
    public function addCart($id){
        $post=DB::table('posts')->where('id',$id)->first();
        $data=array();
        $data['id']=$post->id;
        $data['name']=$post->name;
        $data['qty']=1;
        $data['price']=1000;
        $data['weight']=$post->id;
        $data['options']['image']=$post->image;

        Cart::add($data);
        // return response()->json($data);
        return['success'=>'Added to cart successfully'];
    }

    public function check(){
        $content=Cart::content();
        return response()->json($content);
    }
}
