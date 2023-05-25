<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    public function index()
    {
        //$document = YamlFrontMatter::parseFile(resource_path('names/maikel.html'));
        //\Illuminate\Support\Facades\DB::listen(function ($query) {
        //\Illuminate\Support\Facades\Log::info("foo");
        //logger($query->sql, $query->bindings);
        //});
    
        return view('posts.index', [ 
            'posts' => Post::latest()->filter(
                request(['search', 'category', 'author'])
            )->paginate(6)->withQueryString()//simplePaginate zijn prev en next alleen
            //'categories' => Category::all(),
        ]);
    }
    
    public function show(Post $post)
    {
        return view('posts.show', [ "post" => $post ]);
    }

    public function create()
    {
        // if(auth()->guest()){
        //     abort(403);
        //     //abort(Response::HTTP_FORBIDDEN);
        // }

        return view('admin.posts.create');
    }

    public function store()
    {
        //$path = request()->file('thumbnail')->store('thumbnails');

        $attributes = request()->validate([
            'title' => 'required',
            'thumbnail' => 'required|image',
            'slug' => ['required', Rule::unique('posts', 'slug')],
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }
}
