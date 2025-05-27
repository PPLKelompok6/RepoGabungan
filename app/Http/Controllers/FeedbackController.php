<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedbacks = Feedback::with('user')->get();
        return view('feedback.index', compact('feedbacks'));
    }

    public function store(Request $request)
    {
        \Log::info('Rating received: ' . $request->input('rating'));
        
        $request->validate([
            'rating' => 'required|integer|between::1,5',
            'comment' => 'nullable|string',
        ]);

        Feedback::create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success','Feedback berhasil diberikan!');

    }

    public function destroy($id)
    {
        Feedback::destroy($id);
        return redirect()->back()->with('success', 'Feedback berhasil dihapus!');
    }

}