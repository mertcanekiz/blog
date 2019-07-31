<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notification;
use Faker\Provider\Text;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\TextPost;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tags' => 'required'
        ]);
        $user = User::find(Auth::user()->id);
        $post = TextPost::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content']
        ]);
        foreach (explode(',', $validatedData['tags']) as $tag_data) {
            $tag = Tag::where('name', '=', $tag_data)->first();
            if ($tag == null) {
                $tag = Tag::create([
                    'name' => $tag_data
                ]);
            }
            $tag->posts()->attach($post);
        }
        $user->posts()->save($post);
        return redirect(route('home'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = TextPost::find($id);
        return view('singlePost', ['post' => $post]);
    }
    public function comment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255'
        ]);
        $user = Auth::user();
        $post = TextPost::find($id);
        if ($user != null && $post != null) {
            $comment = Comment::create($validatedData);
            $user->comments()->save($comment);
            $post->comments()->save($comment);
        }
        return view('components.comment', ['comment' => $comment]);
    }

    public function deleteComment(Request $request, $id)
    {
        $validatedData = $request->validate([
            'comment_id' => 'required'
        ]);
        $post = TextPost::find($id);
        $comment = Comment::find($validatedData['comment_id']);
        if ($comment->user->id == Auth::user()->id){
            $comment->delete();
        }
        return redirect()->back();
    }

    public function like(Request $request, $id)
    {
        $auth_user = Auth::user();
        $user_id = $auth_user->id;
        $username = $auth_user->username;
        $post = TextPost::find($id);
        $user = $post->likedBy->find($user_id);
        $liked = false;
        if ($user == null){
            $post->likedBy()->attach($user_id);
            $post->user->notifications()->save(Notification::create([
                'content' => "<strong>$auth_user->username</strong> liked your post",
                'is_read' => false,
                'url' => route('posts.show', ['id' => $post->id])
            ]));
            $liked = true;
        } else {
            $post->likedBy()->detach($user_id);
        }
        return response()->json(['liked' => $liked]);
    }

    public function bookmark(Request $request, $id)
    {
        $user_id = Auth::user()->id;
        $post = TextPost::find($id);
        $user = $post->bookmarkedBy->find($user_id);
        $bookmarked = false;
        if ($user == null){
            $post->bookmarkedBy()->attach($user_id);
            $bookmarked = true;
        } else {
            $post->bookmarkedBy()->detach($user_id);
        }
        return response()->json(['bookmarked' => $bookmarked]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function likedpost(){
        return view('likePost', ['posts' => Auth::user()->likedPosts->sortByDesc('created_at')]);
    }
    public function bookmarkedpost(){
        return view('bookmarkPost', ['posts' => Auth::user()->bookmarkedPosts->sortByDesc('created_at')]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = TextPost::find($id);
        if ($post->user->id == Auth::user()->id){
            $post->delete();

        }
        return redirect()->back();
    }
}