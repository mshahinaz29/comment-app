<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::orderBy('sequence')->get();
        // dd($comments);


        return view('welcome', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->text = $request->text;
        $comment->commented_by = $request->commented_by;
        $comment->parent_id = $request->parent_id;
        $comment->level = $request->level;
        $comment->save();
        $comment->sequence;
        if(!$comment->parent_id){
            $comment->sequence = $comment->id;
        }else{
            //Check if parent has parent
            $parent_comment = Comment::find($comment->parent_id);
            if($parent_comment->parent_id){
                //if parent has parent
                $comment->sequence = $parent_comment->parent_id .'.'. $comment->parent_id .'.'. $comment->id;
            }else{
                $comment->sequence = $comment->parent_id .'.'. $comment->id;
            }
        }
        $comment->save();

        return response()->json(['message' => 'Comment Successful', 'data' => $comment]);
    }

    public function fetch()
    {
        $comments = Comment::orderBy('sequence')->get();

        return response()->json($comments);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
