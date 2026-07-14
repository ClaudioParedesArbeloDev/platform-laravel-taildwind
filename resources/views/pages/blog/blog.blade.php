@extends('components.layout.layout')

@section('title', 'Code & Lens - ' . $blog->title)

@section('content')

<div class="text-text-900 p-4 font-three flex justify-center">

    <div class="lg:w-4/6 lg:py-8 flex flex-col w-full">
        <div class="flex justify-between items-center">
            <a href="{{ route('blogs.index') }}" class="flex items-center gap-2 text-sm text-text-500 hover:text-variant-100 transition-colors">
                <i class="fa-solid fa-arrow-left"></i> {{ __('Back') }}
            </a>

            @auth
                @if (Auth::user()->hasRole('admin'))
                    <div class="flex gap-4">
                        <a href="{{ route('blogs.edit', $blog) }}" class="text-sm text-blue-600 hover:text-blue-800">
                            <i class="fa-solid fa-pen"></i> {{ __('Edit') }}
                        </a>
                        <form action="{{ route('blogs.destroy', $blog) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 hover:text-red-800">
                                <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                @endif
            @endauth
        </div>

        <span class="text-xs uppercase tracking-wide text-variant-100 mt-6">{{ __($blog->category_label) }}</span>
        <h1 class="text-xl font-bold py-3 lg:text-3xl text-text-900">{{ $blog->title }}</h1>

        <div class="flex justify-between items-center text-xs text-text-500 border-b border-variant-100 pb-4">
            <span>{{ __('Author') }}: {{ $blog->author }}</span>
            <span>{{ $blog->created_at->locale('es')->translatedFormat('j F Y') }}</span>
        </div>

        <div class="flex items-center gap-2 mt-4">
            @auth
                <button type="button"
                        class="like-btn flex items-center gap-2 text-sm px-3 py-1.5 rounded-full border border-variant-100 transition-colors duration-300 {{ $blogLiked ? 'text-red-600 bg-red-50' : 'text-text-500 hover:text-red-600' }}"
                        data-like-url="{{ route('blogs.like', $blog) }}">
                    <i class="fa-solid fa-heart"></i>
                    <span class="like-count">{{ $blogLikesCount }}</span>
                </button>
            @else
                <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}"
                   class="flex items-center gap-2 text-sm px-3 py-1.5 rounded-full border border-variant-100 text-text-500 hover:text-red-600 hover:border-red-300 transition-colors duration-300">
                    <i class="fa-solid fa-heart"></i>
                    <span>{{ $blogLikesCount }}</span>
                </a>
            @endauth
        </div>

        @if ($blog->image)
            <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-60 object-cover rounded-lg py-4 lg:h-120 lg:my-8">
        @endif

        <div class="text-justify lg:text-lg leading-relaxed">
            {!! $blog->body !!}
        </div>

        <div id="comments" class="mt-10 pt-6 border-t border-variant-100 scroll-mt-24">
            <h2 class="font-bold text-text-900 text-lg">{{ __('Comments') }} ({{ $blog->comments->count() }})</h2>

            @auth
                <form action="{{ route('comments.store', $blog) }}" method="POST" class="mt-4">
                    @csrf
                    <textarea name="content" rows="3" required maxlength="2000"
                              placeholder="{{ __('Write a comment...') }}"
                              class="w-full p-3 rounded-md border border-variant-100 bg-background-100 text-text-900 text-sm focus:outline-none focus:ring-2 focus:ring-accent-500">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <div class="flex justify-end mt-2">
                        <button type="submit" class="px-5 py-2 bg-accent-700 text-white text-sm font-medium rounded-md hover:bg-accent-900 transition-colors">
                            {{ __('Post Comment') }}
                        </button>
                    </div>
                </form>
            @else
                <div class="mt-4 p-4 bg-background-500 border border-variant-100 rounded-md text-sm text-text-500">
                    <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}" class="text-variant-100 hover:underline font-semibold">{{ __('Log in') }}</a>
                    {{ __('to leave a comment.') }}
                </div>
            @endauth

            <div class="mt-6 space-y-5">
                @forelse ($blog->comments as $comment)
                    <div class="flex gap-3">
                        <img src="{{ $comment->user && $comment->user->avatar ? asset('storage/avatars/'.$comment->user->avatar->avatar) : asset('images/avatar.png') }}"
                             alt="{{ $comment->user->name ?? __('Deleted user') }}" class="w-9 h-9 rounded-full object-cover shrink-0">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 flex-wrap">
                                <span class="text-sm font-semibold text-text-900">
                                    {{ $comment->user ? $comment->user->name . ' ' . $comment->user->lastname : __('Deleted user') }}
                                </span>
                                <span class="text-xs text-text-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-sm text-text-900 mt-1">{{ $comment->content }}</p>

                            <div class="flex items-center gap-4 mt-2">
                                @auth
                                    <button type="button"
                                            class="like-btn flex items-center gap-1 text-xs transition-colors duration-300 {{ $comment->isLikedBy(Auth::user()) ? 'text-red-600 bg-red-50' : 'text-text-500 hover:text-red-600' }}"
                                            data-like-url="{{ route('comments.like', $comment) }}">
                                        <i class="fa-solid fa-heart"></i>
                                        <span class="like-count">{{ $comment->likes->count() }}</span>
                                    </button>
                                @else
                                    <span class="flex items-center gap-1 text-xs text-text-500">
                                        <i class="fa-solid fa-heart"></i> {{ $comment->likes->count() }}
                                    </span>
                                @endauth

                                @auth
                                    @if (Auth::id() === $comment->user_id || Auth::user()->hasRole('admin'))
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('{{ __('Are you sure?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-text-500 hover:text-red-600 transition-colors">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-text-500">{{ __('Be the first to comment.') }}</p>
                @endforelse
            </div>
        </div>
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

<script>
    document.querySelectorAll('.like-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            btn.disabled = true;

            fetch(btn.dataset.likeUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                var countEl = btn.querySelector('.like-count');
                if (countEl) countEl.textContent = data.count;

                if (data.liked) {
                    btn.classList.add('text-red-600', 'bg-red-50');
                    btn.classList.remove('text-text-500', 'hover:text-red-600');
                } else {
                    btn.classList.remove('text-red-600', 'bg-red-50');
                    btn.classList.add('text-text-500', 'hover:text-red-600');
                }
            })
            .catch(function (err) { console.error('Like error:', err); })
            .finally(function () { btn.disabled = false; });
        });
    });
</script>

@endsection