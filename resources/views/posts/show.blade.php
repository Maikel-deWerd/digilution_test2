<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-6xl mx-auto mt-10 lg:mt-20 space-y-6">
            <article class="max-w-4xl mx-auto lg:grid lg:grid-cols-12 gap-x-10">
                <div class="col-span-4 lg:text-center lg:pt-14 mb-10">
                    <img src="/storage/{{ $post->thumbnail }}" alt="" class="rounded-xl">

                    <p class="mt-4 block text-gray-400 text-xs">
                        Published <time>{{ $post->created_at->diffForHumans() }}</time>
                    </p>

                    <div class="flex items-center lg:justify-center text-sm mt-4">
                        <img src="/images/lary-avatar.svg" alt="Lary avatar">
                        <div class="ml-3 text-left">
                            <h5 class="font-bold"><a href="/?author={{ $post->author->username }}">{{ $post->author->name }}</a></h5>
                            <h6>Mascot at Laracasts</h6>
                        </div>
                    </div>
                </div>

                <div class="col-span-8">
                    <div class="hidden lg:flex justify-between mb-6">
                        <a href="/"
                            class="transition-colors duration-300 relative inline-flex items-center text-lg hover:text-blue-500">
                            <svg width="22" height="22" viewBox="0 0 22 22" class="mr-2">
                                <g fill="none" fill-rule="evenodd">
                                    <path stroke="#000" stroke-opacity=".012" stroke-width=".5" d="M21 1v20.16H.84V1z">
                                    </path>
                                    <path class="fill-current"
                                        d="M13.854 7.224l-3.847 3.856 3.847 3.856-1.184 1.184-5.04-5.04 5.04-5.04z">
                                    </path>
                                </g>
                            </svg>

                            Back to Posts
                        </a>

                        <div class="space-x-2">
                            <x-category-button :category='$post->category'/>
                        </div>
                    </div>

                    <h1 class="font-bold text-3xl lg:text-4xl mb-10">
                        {{ $post->title }}
                    </h1>

                    <div class="space-y-4 lg:text-lg leading-loose">
                        {{ $post->body }}
                    </div>
                </div>
                <section class="col-span-8 col-start-5 mt-10">
                    @auth
                        <form method="POST" action="/posts/{{ $post->slug }}/comments" class="border border-gray-200 p-6 rounded-xl">
                        @csrf
                            <header class="flex items-center">
                                <h2>Want to participate?</h2>
                            </header>
                            <div class="mt-6">
                                <textarea name="body" class="w-full text-sm focus:outline-none focus-ring" id="" cols="30" rows="10" required placeholder="Quick, think of something to say!"></textarea>
                            </div>

                            @error('body')
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                            <div>
                                <button type="submit" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">Post</button>
                            </div>
                        </form>  
                    @else
                        <p class="font-semibold">
                            <a href="/register" class="hover:underline">Register</a> or <a href="/login" class="hover:underline">Log in </a>  to leave a comment.  
                        </p>       
                    @endauth
                    @foreach ($post->comments as $comment)
                        <x-post-comment :comment='$comment'/>
                    @endforeach
                    
                </section>
            </article>
        </main>
    </section>
</x-layout>