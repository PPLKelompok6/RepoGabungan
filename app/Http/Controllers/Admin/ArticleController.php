<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title);
        $article->user_id = auth()->user()->id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/articles'), $imageName);
            $article->image = 'images/articles/' . $imageName;
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $article->title = $request->title;
        $article->content = $request->content;
        $article->slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($article->image && file_exists(public_path($article->image))) {
                unlink(public_path($article->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/articles'), $imageName);
            $article->image = 'images/articles/' . $imageName;
        }

        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Article $article)
    {
        if ($article->image && file_exists(public_path($article->image))) {
            unlink(public_path($article->image));
        }
        
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }
}