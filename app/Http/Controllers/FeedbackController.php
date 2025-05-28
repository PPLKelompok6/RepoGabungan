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
        try {
            $request->validate([
                'rating' => 'required|integer|between:1,5',
                'comment' => 'nullable|string|max:1000',
            ]);

            Feedback::create([
                'user_id' => auth()->id(),
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);

            return redirect()->back()->with('success', 'Feedback berhasil diberikan!');
        } catch (\Exception $e) {
            \Log::error('Error saving feedback: ' . $e->getMessage());
            return redirect()->back()
                           ->with('error', 'Terjadi kesalahan saat menyimpan feedback.')
                           ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $feedback = Feedback::findOrFail($id);
            $feedback->delete();
            return redirect()->back()->with('success', 'Feedback berhasil dihapus!');
        } catch (\Exception $e) {
            \Log::error('Error deleting feedback: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus feedback.');
        }
    }
}