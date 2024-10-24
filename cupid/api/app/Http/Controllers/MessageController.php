<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $message = Message::with('user')->orderBy('created_at', 'desc')
                                        ->get();

        return response()->json([
            'success' => true,
            'message' => 'Messages fetch sucessfully',
            'result' => $message
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'content' => 'required|min:5'
        ]);

        $message = Message::create([ ...$validatedData, 'user_id' => $user->id ]);

        return response()->json([
            'success' => true,
            'message' => 'Message created successfully.',
            'result' => $message
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        $user = Auth::user();

        $message = Message::with('user')
                          ->where('user_id', $user->id)
                          ->get();

        return response()->json([
            'message' => 'Fetch specific message successfully.',
            'result' => $message
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Message $message)
    {
        $validatedData = $request->validate([
            'content' => 'required|min:5'
        ]);

        $message->update($validatedData);

        return response()->json([
            'message' => 'Message updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json([
            'message' => 'Message deleted successfully.'
        ]);
    }
}
