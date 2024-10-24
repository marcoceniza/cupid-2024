<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment = Comment::with('message')->get();

        return response()->json([
            'message' => 'Comment fetch successfully.',
            'result' => $comment
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|min:5'
        ]);

        $msg = Message::where('user_id', Auth::id())->get();

        $comment = Comment::create([
            ...$validatedData,
            'user_id' => Auth::id(),
            'message_id' => $msg->id
        ]);

        return response()->json([
            'message' => 'Comment added successfully.',
            'result' => $comment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($message_id)
    {
        $auth = Auth::user();
    
        $comments = Comment::where('message_id', $message_id)
                           ->where('user_id', $auth->id)
                           ->get();
    
        return response()->json([
            'success' => true,
            'message' => 'Comments fetched successfully',
            'result' => $comments
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
