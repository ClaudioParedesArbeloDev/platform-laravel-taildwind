@extends('components.layout.layout')

@section('title', 'Code & Lens - Blogs')

@section('content')

<div class="flex flex-col items-center w-full">

   
    <section class="w-full flex flex-col items-center text-center px-4 py-10 lg:py-14">
        <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
            {{ __('Platform') }}
        </p>
        <h1 class="font-three font-bold text-xl leading-tight lg:text-4xl text-text-500">
            {{ __("What's New") }}
        </h1>
    </section>

    <div class="w-full max-w-7xl px-4 lg:px-16 pb-12">

      
        @if ($categories->count() > 1)
            <div class="flex flex-wrap justify-center gap-2 mb-8">
                <a href="{{ route('blogs.index') }}"
                   class="font-five text-xs uppercase tracking-wide px-4 py-2 rounded-full border transition-colors duration-300
                          {{ !$category ? 'bg-accent-900 text-white border-accent-900' : 'border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900' }}">
                    {{ __('All Categories') }}
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('blogs.index', ['category' => $cat]) }}"
                       class="font-five text-xs uppercase tracking-wide px-4 py-2 rounded-full border transition-colors duration-300
                              {{ $category === $cat ? 'bg-accent-900 text-white border-accent-900' : 'border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900' }}">
                        {{ __(\App\Models\Blog::categoryLabel($cat)) }}
                    </a>
                @endforeach
            </div>
        @endif

        
        @if ($blogs->isEmpty())
            <div class="flex flex-col items-center text-center py-16">
                <i class="fa-solid fa-newspaper text-4xl text-variant-100 mb-4"></i>
                <p class="font-three text-text-500">{{ __('No blog posts available right now.') }}</p>
            </div>
        @else
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($blogs as $blog)
                    <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden hover:-translate-y-1 transition-transform duration-300">
                        <a href="{{ route('blogs.show', $blog) }}">
                            @if ($blog->image)
                                <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-44 object-cover">
                            @else
                                <div class="w-full h-44 bg-accent1-300 flex items-center justify-center">
                                    <i class="fa-solid fa-newspaper text-3xl text-accent1-900"></i>
                                </div>
                            @endif
                        </a>
                        <div class="p-4 flex flex-col grow">
                            <p class="text-xs uppercase tracking-wide text-variant-100">{{ __($blog->category_label) }}</p>
                            <h3 class="text-base font-bold text-text-900 mt-1 line-clamp-2">
                                <a href="{{ route('blogs.show', $blog) }}" class="hover:text-variant-100 transition-colors">{{ $blog->title }}</a>
                            </h3>
                            <p class="text-sm text-text-500 mt-2 line-clamp-3">{!! strip_tags($blog->anticipated) !!}</p>

                            <div class="flex justify-between items-center text-xs text-text-500 mt-3">
                                <span>{{ $blog->author }}</span>
                                <span>{{ $blog->created_at->format('d/m/Y') }}</span>
                            </div>

                            <a href="{{ route('blogs.show', $blog) }}"
                               class="mt-4 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                                <span>{{ __('Read More') }}</span>
                            </a>

                            @auth
                                @if (Auth::user()->hasRole('admin'))
                                    <div class="flex gap-3 mt-3 pt-3 border-t border-variant-100">
                                        <a href="{{ route('blogs.edit', $blog) }}" class="text-xs text-blue-600 hover:text-blue-800">
                                            <i class="fa-solid fa-pen"></i> {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-red-600 hover:text-red-800">
                                                <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-10 flex justify-center">
                {{ $blogs->links() }}
            </div>
        @endif
    </div>
</div>

@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '{{ session('success') }}',
            confirmButtonText: 'Aceptar'
        });
    </script>
@endif

@endsection