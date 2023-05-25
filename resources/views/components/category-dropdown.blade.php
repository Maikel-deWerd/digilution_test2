<x-dropdown>
                        <x-slot name="trigger">
                            <button class="py-2 pl-3 pr-9 text-sm font-semibold inline-flex">
                            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories' }}
                            <x-icon name="down-arrow" class="absolute pointer-events-none" style="right: 12px;" />
                        </button>
                        </x-slot>
                        <a href="/?{{ http_build_query(request()->except('category', 'page')) }}" class="block text-left px-3 text-sm leading-6 hover:bg-gray-300 focus:bg-gray-300">All</a>
                            @foreach ($categories as $category)
                                <a href="/?category={{ $category->slug }}&{{ http_build_query(request()->except('category', 'page')) }}" class="block text-left px-3 text-sm leading-6 hover:bg-gray-300 focus:bg-gray-300">{{ucwords($category->name)}}</a>
                            @endforeach
                    </x-dropdown>