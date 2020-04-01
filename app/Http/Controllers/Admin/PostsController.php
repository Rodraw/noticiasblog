<?php

namespace App\Http\Controllers\Admin;


use App\Tag;
use App\Post;
use App\Category;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    public function index()
    {
    	$posts = Post::all();

    	return view('admin.posts.index', compact('posts'));
    }

    //     public function create()
    // {

    // 	$categories = Category::all();
    //     $tags = Tag::all();

    // 	return view('admin.posts.create', compact('categories','tags'));
    // }

public function store(Request $request)
{
    $this->validate($request, ['title' => 'required']);


    $post = Post::create([
        'title' => $request->get('title'),
        'url' => Str::slug($request->get('title')),
    ]);

    return redirect()->route('admin.posts.edit', $post);
}

public function edit(Post $post)
{
    $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('categories','tags', 'post'));
    return view('admin.posts.edit', compact('post'));
}
    public function update(Post $post, Request $request)
    {   
        $this->validate( $request, [

            'title' => 'required',
            'body' => 'required',
            'category' => 'required',
            'tags' => 'required',
            'excerpt' => 'required'
        ]);

    //return Post::create($request->all());


        $post->title = $request->get('title');
        $post->url = Str::slug($request->get('title'));
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = $request->has('published_at') ? Carbon::parse($request->get('published_at')) : null;
        $post->category_id = $request->get('category');
        $post->save();

        $post->tags()->sync($request->get('tags'));

        return redirect()->route('admin.posts.edit', $post)->with('flash', 'Tu publicación ha sido guardada');

    }

 }
