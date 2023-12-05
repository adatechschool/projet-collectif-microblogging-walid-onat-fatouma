<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    public function getLikes($postId){
        $likes = Like::where("post_id", $postId)->count();
        // $likes = 33;
        return $likes;
    }

    public function checkLike($postId) {
        if(Like::where("post_id", $postId)->where("user_id", auth()->user()->id)->count() > 0){
            return true;
        }
    }
    public function likeIt(Request $request){

        if($this->checkLike($request->postId)){
            return redirect('/post');
        }
        $like = new Like;
        $like->user_id = auth()->user()->id;
        $like->post_id = $request->postId;
        $like->save();

        return redirect('/post');
    }
}
