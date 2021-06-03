<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use DB;

class PostController extends Controller
{
    public function searchById($id)
    {
        $post = Post::where('id', '=', $id)->first();
        if ($post === null) {
            return 'no result';
        }
        return json_encode($post);
    }

    public function searchByUserId($user_id)
    {
        $posts = Post::where('user_id', '=', $user_id)->get();
        if ($posts === null) {
            return 'no result';
        }
        return json_encode($posts);
    }

    public function searchByContent($string)
    {
        $posts = Post::where('body', 'like', '%'.$string.'%')->get();
        if ($posts === null) {
            return 'no result';
        }
        return json_encode($posts);
    }
}
