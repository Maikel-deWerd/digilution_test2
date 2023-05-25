<x-layout>
    <section class="px-6 py-8 max-w-md mx-auto">
        <h1 class="text-lg font-bold mb-4">
            Publish new post!
        </h1>
        <div class="max-w-sm mx-auto">
            <form action="/admin/posts" method="post" enctype="multipart/form-data">
            @csrf

                <x-form.input name='title' />
                <x-form.input name='slug' />
                <x-form.input name='thumbnail' type="file "/>
                <x-form.input name='excerpt' />
                <x-form.input name='body' />
                <div class="mb-6">
                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700" for="category_id">
                        Category
                    </label> 
                    <select name="category_id" id="category_id">
                        @php
                            $categories = \App\Models\Category::all();
                        @endphp
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucwords($category->name) }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <button type="submit" class="bg-blue-400 text-white rounded py-2 px-4 hover:bg-blue-500">
                        Publish
                    </button>
                </div>
            </form>
        </div>
    </section>
</x-layout>