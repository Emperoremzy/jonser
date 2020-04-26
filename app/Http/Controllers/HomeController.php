<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\post;
use App\comment;
use App\user;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function user()
    {
        $comments = comment::all();
        $posts=  post::all();
        $count = comment::all()->count();
       
        return view('category',['post'=>$posts],['comments'=>$comments],['count'=>$count]);
    }  
    public function createCmt($id,$c_o)
    {
        $comments = new comment();
       $comments->post_id = $id;
       $comments->c_owner = $c_o;
       $comments->comment = request('comment');
       $comments->save();
       return redirect('/category');
    }
    public function adminHome()
    {
        $posts=  post::all();
        $user = User::select('*')->where('is_admin','=', 1)->get();
        return view('adminHome',['post'=>$posts],['user'=>$user]);
    }
  
    public function createPost()
    {
        $post = new post();
        $post->post_title = request('post_title');
        $post->mes_post = request('mes_post');
        $post->save();
        return redirect('adminHome')->with('mssg', 'your post has been uploaded!!!');
    }
    public function destroy($id)
    {
        $posts = post::findOrFail($id);
        $comment = comment::where('post_id','=',$id);
        $comment->delete();
        $posts->delete();
        return redirect('adminHome');
    }
  
}
