<?php

namespace App\Http\Controllers;

use App\Models\ForumPost;
use App\Models\ForumComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::with('user')->latest()->get();
        return view('forum.index', compact('posts'));
    }

    public function show($id)
    {
        $post = ForumPost::with('comments.user')->findOrFail($id);
        return view('forum.show', compact('post'));
    }

    public function create()
    {
        return view('forum.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = ForumPost::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('forum.index')->with('success', 'Postingan berhasil dibuat.');
    }

    public function edit($id)
    {
        $post = ForumPost::findOrFail($id);
        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = ForumPost::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);

        return redirect()->route('forum.index')->with('success', 'Postingan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id);
        $post->delete();

        return redirect()->route('forum.index')->with('success', 'Postingan berhasil dihapus.');
    }
}