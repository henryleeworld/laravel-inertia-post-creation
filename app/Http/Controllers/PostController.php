<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        Gate::authorize('viewAny', Post::class);

        $posts = PostResource::collection(Post::all());

        return Inertia::render('Posts/Index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        Gate::authorize('create', Post::class);

        return Inertia::render('Posts/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): RedirectResponse
    {
        Gate::authorize('create', Post::class);

        Post::create($request->validated());

        return redirect()->route('posts.index')
            ->with('message', __('Post created successfully'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        Gate::authorize('create', Post::class);

        return Inertia::render('Posts/Edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Post $post, StorePostRequest $request)
    {
        Gate::authorize('create', Post::class);

        $post->update($request->validated());

        return redirect()->route('posts.index')
            ->with('message', __('Post updated successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Gate::authorize('create', Post::class);

        $post->delete();

        return redirect()->route('posts.index')
            ->with('message', __('Post deleted successfully'));
    }
}
