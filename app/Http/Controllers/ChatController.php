<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Get list of users to chat with based on role
        if ($user->role === 'admin') {
            $users = User::where('role', 'user')->get();
        } else {
            $users = User::where('role', 'admin')->get();
        }

        // Get or set receiver_id
        $receiver_id = $request->query('user_id');
        if (!$receiver_id && $users->count() > 0) {
            $receiver_id = $users->first()->id;
        }

        // Get messages if receiver_id is set
        $messages = [];
        if ($receiver_id) {
            $messages = ChatMessage::where(function($query) use ($user, $receiver_id) {
                $query->where('sender_id', $user->id)
                      ->where('receiver_id', $receiver_id);
            })->orWhere(function($query) use ($user, $receiver_id) {
                $query->where('sender_id', $receiver_id)
                      ->where('receiver_id', $user->id);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('created_at', 'asc')
            ->get();
        }

        return view('chat.index', compact('messages', 'users', 'receiver_id'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string'
        ]);

        $message = ChatMessage::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message
        ]);

        return response()->json([
            'status' => 'success',
            'message' => $message->load('sender')
        ]);
    }

    public function getMessages($userId)
    {
        $user = Auth::user();
        $messages = ChatMessage::where(function($query) use ($user, $userId) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($user, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $user->id);
        })
        ->with(['sender', 'receiver'])
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }
}
