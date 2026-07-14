<div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mb-6">

    <div class="flex flex-col items-center mb-8">
        @if (isset($course) && $course->image)
            <img class="w-40 h-28 object-cover rounded-xl border-2 border-variant-100" src="{{ asset('storage/courses/' . $course->image) }}" alt="{{ $course->name }}">
        @else
            <div class="w-40 h-28 rounded-xl border-2 border-variant-100 bg-accent1-300 flex items-center justify-center">
                <i class="fa-solid fa-graduation-cap text-2xl text-accent1-900"></i>
            </div>
        @endif

        <label for="image" class="mt-4 text-xs uppercase tracking-wide text-variant-100 cursor-pointer hover:underline">
            {{ __('Change image') }}
        </label>
        <input class="hidden" type="file" name="image" id="image" accept="image/*"
               onchange="this.closest('form').querySelector('#image-filename').textContent = this.files[0]?.name ?? ''">
        <span id="image-filename" class="text-xs text-text-500 mt-1"></span>

        @error('image')
            <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
        @enderror
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">

        <div class="sm:col-span-2">
            <label for="name" class="text-sm font-medium block mb-1">{{ __('Title') }} *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $course->name ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label for="description" class="text-sm font-medium block mb-1">{{ __('Description') }} *</label>
            <textarea id="description" name="description" rows="5"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 resize-none @error('description') border-red-500 @enderror">{{ old('description', $course->description ?? '') }}</textarea>
            @error('description')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category" class="text-sm font-medium block mb-1">{{ __('Category') }}</label>
            <select id="category" name="category"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('category') border-red-500 @enderror">
                @php $category = old('category', $course->category ?? ''); @endphp
                <option value="programacion" {{ $category === 'programacion' ? 'selected' : '' }}>{{ __('Programming') }}</option>
                <option value="fotografia" {{ $category === 'fotografia' ? 'selected' : '' }}>{{ __('Photography') }}</option>
                <option value="filmmaking" {{ $category === 'filmmaking' ? 'selected' : '' }}>{{ __('Filmmaking') }}</option>
            </select>
            @error('category')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="user_id" class="text-sm font-medium block mb-1">{{ __('Instructor') }} *</label>
            <select id="user_id" name="user_id"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('user_id') border-red-500 @enderror">
                <option value="">{{ __('Select an instructor') }}</option>
                @php $selectedUser = old('user_id', $course->user_id ?? null); @endphp
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ (int) $selectedUser === $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="text-sm font-medium block mb-1">{{ __('Price') }} ($) *</label>
            <input id="price" type="number" step="0.01" min="0" name="price" value="{{ old('price', $course->price ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('price') border-red-500 @enderror">
            <p class="text-xs text-text-500 mt-1">{{ __('Use 0 for free courses.') }}</p>
            @error('price')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="duration" class="text-sm font-medium block mb-1">{{ __('Duration') }}</label>
            <input id="duration" type="text" name="duration" value="{{ old('duration', $course->duration ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('duration') border-red-500 @enderror">
            @error('duration')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="capacity" class="text-sm font-medium block mb-1">{{ __('Capacity') }}</label>
            <input id="capacity" type="number" min="0" name="capacity" value="{{ old('capacity', $course->capacity ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('capacity') border-red-500 @enderror">
            @error('capacity')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="days1" class="text-sm font-medium block mb-1">{{ __('Days') }} 1</label>
            <input id="days1" type="text" name="days1" value="{{ old('days1', $course->days1 ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('days1') border-red-500 @enderror">
            @error('days1')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="days2" class="text-sm font-medium block mb-1">{{ __('Days') }} 2</label>
            <input id="days2" type="text" name="days2" value="{{ old('days2', $course->days2 ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('days2') border-red-500 @enderror">
            <p class="text-xs text-text-500 mt-1">{{ __('Set both to enable a two-day schedule with separate capacity per day.') }}</p>
            @error('days2')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="flex items-center gap-x-8 mt-6 pt-6 border-t border-variant-100">
        @php $active = old('active', $course->active ?? true); @endphp
        <label class="flex items-center gap-x-2 text-sm cursor-pointer">
            <input type="checkbox" name="active" value="1" {{ $active ? 'checked' : '' }}
                class="w-4 h-4 rounded border-variant-100 text-accent-900 focus:ring-accent-900">
            {{ __('Active') }}
        </label>
    </div>

</div>
