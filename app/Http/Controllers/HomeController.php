<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;
use App\post;
use Auth;
use App\User;
use App\comment;
use App\Description;
use App\TodoList;
use App\Article;
use App\Review;
use App\Reply;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Member::all();
        return view('home',compact('data'));
    }

    
    public function add_member(){
        
        return view('add_member');
  

    }

    public function post_member(Request $req){
        $member = new Member;
        // $member->name = $req->name;
        // $member->rank = $req->rank;
        // $member->company = $req->company;
        // $member->save();

        $data = ['name'=>$req->name,'rank'=>$req->rank,'company'=>$req->company];
        $member::create($data);

        return redirect()->back()->with('status',"Member Added successfully");
    }


    public function delete_member($id){
        if ($member = Member::where('id', '=', $id)->first())
        {
            $member->delete();
            return redirect()->back()->with('status',"Deleted successfully");
        }

    }


    public function update_member($id){
        $data = Member::find($id);
        return view('update_member',compact('data'));
    }


    public function post_update(Request $req,$id){

        // $member = Member::find($id);
        // $member->name = $req->name;
        // $member->rank = $req->rank;
        // $member->company = $req->company;
        // $member->save();

        Member::where('id',$id)->update(['name'=>$req->name,'rank'=>$req->rank,'company'=>$req->company]);

        return redirect()->back()->with('status',"Updated successfully");
    }

    // public function create_post(){
    //     return view('create_post');
      
    // }

    public function post(Request $req){
        $post = new post;
        $userId = Auth::id();
        if (post::where('user_id', $userId)->exists()){
                return redirect()->back()->with('failed',"more than 1 post not allowed"); 
            }
            else{
                $data = ['title'=>$req->title,'description'=>$req->description,'user_id'=>$userId];
                $post::create($data);
                return redirect()->back()->with('status',"Your Post Added successfully");
            }
    }

    public function all_post(){
        $posts = Post::all();

        return view('all_post', compact('posts'));
    }

    // public function post_detail($id){
    //     $data = post::find($id);
    //     $comment = post::with('comment.description')->where('id', $id)->get();
        // echo '<pre>';
        // print_r($comment);
        // die();
        // for($x=0,$count=count($comment);$x<$count;$x++){
        //          $comment[$x]['id'] . '----' . $comment[$x]['title']; 
        //          $post= $comment[$x]['title'];
        //     for($i=0,$count1=count($comment[$x]['comment']);$i<$count1;$i++){
        //         echo '<br>';
        //         // echo $comment[$x]['comment'][$i]['id'] . '----' . $comment[$x]['comment'][$i]['comment'];
        //         $comments=$comment[$x]['comment'][$i];
        //         // return $comments;
        //         for($c=0,$count2=count($comment[$x]['description']);$c<$count2;$c++){
        //             // dd($comment[$x]['comment']);
        //         }
        //     }
            // dd($comment[$x]);
        // }
        // $reply = comment::with('description','post')->get();
    //     return view('post_detail',compact('data','comment'));

    // }


    public function create(){
        return view('create_post');
    }

    public function store(Request $req){
        $post =  new post;
            $data = ['title'=>$req->title,'body'=>$req->body];
            $post::create($data);
            return redirect()->back()->with('status',"Your Post Added successfully");
    }

    public function update_post($id){

        $update_post = post::find($id);
        return view('update_post',compact('update_post'));

    }

    public function update(Request $req, $id){
        $post = post::find($id);
        $comment = ['title' => $req->title,'body'=>$req->body,];
        $post->update($comment);
        return redirect()->back()->with('status',"Your Post Updated successfully");

    }

    public function show_post($id){
    $post = Post::with('comments')->find($id);

    return view('post_detail', compact('post'));
}

public function store_comment(Request $request){
    $comment = new comment;
    $comment->body = $request->get('comment_body');

    $comment->user()->associate($request->user());
    
    $post = Post::find($request->get('post_id'));
    $post->comments()->save($comment);
    return back();
}

public function replyStore(Request $request){
    $reply = new Comment();
    $reply->body = $request->get('comment_body');
    $reply->user()->associate($request->user());
    $reply->parent_id = $request->get('comment_id');
    $post = Post::find($request->get('post_id'));

    $post->comments()->save($reply);

    return back();

}

    public function add_todo(){
        $todos = TodoList::orderBy('id','DESC')->get();
        return view('todo',compact('todos'));

    }
    public function todo_edit(Todo $todo){
        return response()->json($todo);
    }

    public function todo_store(Request $request){
       return 'hi';
        $todo = Todo::Create([
            'id'=>$request->id,
            'name'=>$request->name
            ]);

        return response()->json([
            'message'=>'data added successfully'
        ]);

    }

    public function destroy(Todo $todo){
        $todo->delete();
        return response()->json('success');
    }

    public function make_admin(){
        $user = User::all();
        return view('admin_all_users',compact('user'));

    }
    public function change_role($id){
        $user = User::find($id);
        if($user->user_type==0){
            $user->user_type = 1;
        }
        elseif($user->user_type==1){
            $user->user_type = 0;
        }
        $user->save();
         return redirect()->back()->with('status',"Role Assigned successfully");

        // if(Auth::User()->user_type==0)
        // {
        //     User::where('id',$id)->update(['user_type'=>1]);
        // }
    
        // elseif(Auth::User()->user_type==1){
        //     User::where('id',$id)->update(['user_type'=>0]);
            
        // }
        // return redirect()->back()->with('status',"Role Assigned successfully");

    }

    public function delete_user($id){
        if ($user = User::where('id', '=', $id)->first()){
            $user->delete();
            return redirect()->back()->with('status',"Deleted successfully");
        }
    }

    public function notAllowed(){
        return view('notAllowed');
    }

/*
|--------------------------------------------------------------------------
| ARTICLE 
|--------------------------------------------------------------------------
*/

    public function add_article(){
        return view('add_article');
    }

    public function store_article(Request $req){
        $this->validate($req, [
            'title' => 'required|max:255|unique:posts',
            'body' => 'required',
        ]);

        $article = new Article();
        $user_id = Auth::id();
        $data = ['title'=>$req->title,'body'=>$req->body,'user_id'=>$user_id];
        $article::create($data);
        return redirect()->back()->with('status',"Added successfully");

    }
    public function show_article(){
        $article = Article::all();
        return view('articles', compact('article'));
    }

    public function article_detail($id){
        $article_detail = Article::with('reviews.replies','user')->findOrFail($id);
        return view('article_detail', compact('article_detail'));
    }

    public function store_review(Request $request, $id){
        $this->validate($request, ['message' => 'required|max:1000']); 
        $comment = new Review();
        $comment->article_id = $id;
        $comment->user_id = Auth::id();
        $comment->message = $request->message; 
        $comment->save();  
        return response()->json([
            'comment' => $comment,
            'user' => Auth::user()
        ]);
   }

   public function store_replies(Request $request, $id){
       $this->validate($request, ['body' => 'required|max:1000']);
       $reply = new Reply();
       $reply->review_id = $id;
       $reply->user_id = Auth::id();
       $reply->body = $request->body;
       $reply->save();
       return response()->json([
        'success' => true,
        'reply' => $reply,
        'user' => Auth::user()
    ]);
   }

/*
|--------------------------------------------------------------------------
| END ARTICLE 
|--------------------------------------------------------------------------
*/

}