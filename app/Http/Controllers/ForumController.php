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
        $posts = ForumPost::with(['user', 'comments'])
            ->withCount('comments')
            ->latest()
            ->paginate(10);
        return view('forum.index', compact('posts'));
    }

    public function show($id)
    {
        $post = ForumPost::with(['user', 'comments.user', 'comments.replies.user'])
            ->findOrFail($id);
        
        // Tambahkan increment view count
        $post->incrementViewsCount();
        
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
            'topic' => 'required|string',
            'status' => 'required|in:publik,anonim,privasi'
        ]);

        $post = ForumPost::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
            'topic' => $validated['topic'],
            'status' => $validated['status']
        ]);

        return redirect()->route('forum.index')
            ->with('success', 'Diskusi berhasil dibuat');
    }

    public function edit($id)
    {
        $post = ForumPost::findOrFail($id);
        
        // Pastikan user yang edit adalah pemilik post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('forum.show', $post->id)
                ->with('error', 'Anda tidak memiliki izin untuk mengedit postingan ini.');
        }

        return view('forum.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = ForumPost::findOrFail($id);

        // Cek kepemilikan post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('forum.show', $post->id)
                ->with('error', 'Anda tidak memiliki izin untuk mengedit postingan ini.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|in:umum,penyakit,gaya_hidup,nutrisi,mental'
        ]);

        $post->update($validated);

        return redirect()->route('forum.show', $post->id)
            ->with('success', 'Postingan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $post = ForumPost::findOrFail($id);

        // Cek kepemilikan post
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('forum.show', $post->id)
                ->with('error', 'Anda tidak memiliki izin untuk menghapus postingan ini.');
        }

        $post->delete();

        return redirect()->route('forum.index')
            ->with('success', 'Postingan berhasil dihapus.');
    }

    // Menambahkan komentar
    public function storeComment(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string'  // Sesuaikan dengan nama field di form
        ]);

        $comment = new ForumComment([
            'comment' => $request->comment,  // Sesuaikan dengan nama kolom di database
            'user_id' => Auth::id(),
            'forum_post_id' => $postId
        ]);

        $comment->save();

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    // Menghapus komentar
    public function destroyComment($id)
    {
        $comment = ForumComment::findOrFail($id);

        if ($comment->user_id !== Auth::id()) {
            return redirect()->back()
                ->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
        }

        $comment->delete();

        return redirect()->back()
            ->with('success', 'Komentar berhasil dihapus.');
    }
}