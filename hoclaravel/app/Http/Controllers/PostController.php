<?php

namespace App\Http\Controllers;
use  App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        // $allPosts = Post::all();
        // dd($allPosts);
        // $post = Post::find('c1');
        // dd($post);
        $post = new Post;
        $post->title = 'Bai viet 3';
        $post->content = 'Noi dung 3';
        // $post->status = 1;

        $post->save();
    }
}
