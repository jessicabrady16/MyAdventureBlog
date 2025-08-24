<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest('published_at')->latest()->paginate(10)->through(function ($p) {
            return [
                'id' => $p->id,
                'title' => $p->title,
                'slug' => $p->slug,
                'excerpt' => $p->excerpt,
                'coverUrl' => $p->cover_url,
                'published_at' => optional($p->published_at)->toIso8601String(),
            ];
        });

        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }

    public function create()
    {
        return Inertia::render('Posts/Create', [
            'csrf_token' => csrf_token(),   
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'slug'    => 'nullable|string|max:255|unique:posts,slug',
            'excerpt' => 'nullable|string',
            'body'    => 'required|string',
            'cover'   => 'nullable|image|max:5120',
            'published' => 'nullable|boolean',
        ]);

        $slug = $data['slug'] ?? Str::slug($data['title']) . '-' . Str::random(6);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            // Uses default disk (local in dev, S3 in prod)
            $coverPath = $request->file('cover')->store('covers');
        }

        Post::create([
            'title'        => $data['title'],
            'slug'         => $slug,
            'excerpt'      => $data['excerpt'] ?? null,
            'body'         => $data['body'],
            'cover_path'   => $coverPath,
            'published_at' => !empty($data['published']) ? now() : null,
        ]);

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return Inertia::render('Posts/Show', [
            'post' => [
                'id' => $post->id,
                'title' => $post->title,
                'slug' => $post->slug,
                'excerpt' => $post->excerpt,
                'body' => $post->body,
                'coverUrl' => $post->cover_url,
                'published_at' => optional($post->published_at)->toIso8601String(),
            ]
        ]);
    }
}
