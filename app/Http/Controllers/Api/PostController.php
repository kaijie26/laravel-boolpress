<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index(){
        $posts = Post::paginate(6);
        $data = [
            'success' => true,
            'results' => $posts,
        ];

        return response()->json($data);
       
    }

    public function show($slug){
        $post = Post::where('slug', '=', $slug)->with(['category', 'tags'])->first();

        if($post){
            $data = [
                'success' => true,
                'results' => $post,
            ];

        }else{
            $data = [
                'success' => false,
                
            ];

        }

        return response()->json($data);
    }

}
