<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use DB;
use App\Models\CurlResponse;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  DB::table('post')->select('post.title','post.body','users.name','users.email')
            ->join('users','post.user_id','=','users.id')->
            orderby('post.id','desc')->get();

        return $posts;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = User::where('email', '=', $request->input('email'))->first();
        if ($user === null) {
            $user = new User;
        }
        $user->name = $request->input('name');
        $user->email = $request->input('email');

        if($user->save()) {
            //return true;
            $post = new Post;
            $post->user_id = $user->id;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->save();

        }
        return true;
    }

    public function fetch()
    {
        $curl = new CurlResponse();
        $resularrUser = $curl->getUrlResponse('https://jsonplaceholder.typicode.com/users');
        $jsonDecodedUser = json_decode($resularrUser["result"]);
        foreach($jsonDecodedUser as $valueUser)
        {
            $user = User::where('email', '=', $valueUser->email)->first();
            if ($user === null) {
                $user = new User;
                $user->id = $valueUser->id;
            }else{
                continue;
            }
            $user->name = $valueUser->name;
            $user->email = $valueUser->email;
            $user->save();
            $resularrPost = $curl->getUrlResponse('https://jsonplaceholder.typicode.com/posts?userId='.$valueUser->id);
            $jsonDecodedPost = json_decode($resularrPost["result"]);
            foreach($jsonDecodedPost as $valuePost)
            {
                $post = new Post;
                $post->user_id = $valuePost->userId;
                $post->title = $valuePost->title;
                $post->body = $valuePost->body;
                $post->save();
            }

        }
        return true;


    }
    public function query()
    {
        $sql = 'select user_id,
                    count(id)/(12 * (YEAR(MAX(`created_at`)) - YEAR(MIN(`created_at`))) + (MONTH(MAX(`created_at`)) - MONTH(MIN(`created_at`)))+1) as month_avg,
                    count(id)/(7 * (YEAR(MAX(`created_at`)) - YEAR(MIN(`created_at`))) + (WEEK(MAX(`created_at`)) - WEEK(MIN(`created_at`)))+1) as weekly_avg,
                    count( case when YEAR(`created_at`) = YEAR(`created_at`) and MONTH(`created_at`) = MONTH(NOW()) then id else 0 end) as current_month_total
                    from post group by user_id';
        $posts = DB::select($sql);

        echo '<pre>'.$sql.'</pre>';
        echo '<br>';
        echo '<pre>';
        print_r($posts);
        echo '</pre>';
    }

}
