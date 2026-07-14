<div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mb-6">

    {{-- Imagen --}}
    <div class="flex flex-col items-center mb-8">
        @if (isset($software) && $software->image)
            <img class="w-28 h-28 object-cover rounded-xl border-2 border-variant-100" src="{{ asset('storage/software/' . $software->image) }}" alt="{{ $software->name }}">
        @else
            <div class="w-28 h-28 rounded-xl border-2 border-variant-100 bg-accent2-300 flex items-center justify-center">
                <i class="fa-solid fa-layer-group text-2xl text-accent2-900"></i>
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
            <label for="name" class="text-sm font-medium block mb-1">{{ __('Name') }} *</label>
            <input id="name" type="text" name="name" value="{{ old('name', $software->name ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="sku" class="text-sm font-medium block mb-1">{{ __('SKU') }}</label>
            <input id="sku" type="text" name="sku" value="{{ old('sku', $software->sku ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('sku') border-red-500 @enderror">
            @error('sku')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="category" class="text-sm font-medium block mb-1">{{ __('Category') }}</label>
            <input id="category" type="text" name="category" value="{{ old('category', $software->category ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('category') border-red-500 @enderror">
            @error('category')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label for="short_description" class="text-sm font-medium block mb-1">{{ __('Short description') }}</label>
            <input id="short_description" type="text" name="short_description" maxlength="255" value="{{ old('short_description', $software->short_description ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('short_description') border-red-500 @enderror">
            @error('short_description')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="sm:col-span-2">
            <label for="description" class="text-sm font-medium block mb-1">{{ __('Description') }} *</label>
            <textarea id="description" name="description" rows="5"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 resize-none @error('description') border-red-500 @enderror">{{ old('description', $software->description ?? '') }}</textarea>
            @error('description')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="type" class="text-sm font-medium block mb-1">{{ __('Type') }} *</label>
            <select id="type" name="type"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('type') border-red-500 @enderror">
                @php $type = old('type', $software->type ?? 'generico'); @endphp
                <option value="generico" {{ $type === 'generico' ? 'selected' : '' }}>{{ __('Generic Software') }}</option>
                <option value="medida" {{ $type === 'medida' ? 'selected' : '' }}>{{ __('Custom Software') }}</option>
            </select>
            @error('type')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="platform" class="text-sm font-medium block mb-1">{{ __('Platform') }}</label>
            <select id="platform" name="platform"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('platform') border-red-500 @enderror">
                @php $platform = old('platform', $software->platform ?? ''); @endphp
                <option value="" {{ $platform === '' ? 'selected' : '' }}>—</option>
                <option value="web" {{ $platform === 'web' ? 'selected' : '' }}>Web</option>
                <option value="windows" {{ $platform === 'windows' ? 'selected' : '' }}>Windows</option>
                <option value="mobile" {{ $platform === 'mobile' ? 'selected' : '' }}>Mobile</option>
                <option value="desktop" {{ $platform === 'desktop' ? 'selected' : '' }}>Desktop</option>
            </select>
            @error('platform')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="license_type" class="text-sm font-medium block mb-1">{{ __('License type') }}</label>
            <select id="license_type" name="license_type"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('license_type') border-red-500 @enderror">
                @php $license = old('license_type', $software->license_type ?? ''); @endphp
                <option value="" {{ $license === '' ? 'selected' : '' }}>—</option>
                <option value="unica" {{ $license === 'unica' ? 'selected' : '' }}>{{ __('One-time payment') }}</option>
                <option value="anual" {{ $license === 'anual' ? 'selected' : '' }}>{{ __('Annual license') }}</option>
            </select>
            @error('license_type')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="price" class="text-sm font-medium block mb-1">{{ __('Price') }} ($)</label>
            <input id="price" type="number" step="0.01" min="0" name="price" value="{{ old('price', $software->price ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('price') border-red-500 @enderror">
            @error('price')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="user_id" class="text-sm font-medium block mb-1">{{ __('Instructor') }} *</label>
            <select id="user_id" name="user_id"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('user_id') border-red-500 @enderror">
                <option value="">{{ __('Select an instructor') }}</option>
                @php $selectedUser = old('user_id', $software->user_id ?? null); @endphp
                @foreach ($users as $u)
                    <option value="{{ $u->id }}" {{ (int) $selectedUser === $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="demo_url" class="text-sm font-medium block mb-1">{{ __('Demo URL') }}</label>
            <input id="demo_url" type="url" name="demo_url" value="{{ old('demo_url', $software->demo_url ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('demo_url') border-red-500 @enderror">
            @error('demo_url')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="manual_url" class="text-sm font-medium block mb-1">{{ __('Manual URL') }}</label>
            <input id="manual_url" type="url" name="manual_url" value="{{ old('manual_url', $software->manual_url ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('manual_url') border-red-500 @enderror">
            @error('manual_url')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="download_url" class="text-sm font-medium block mb-1">{{ __('Download URL') }}</label>
            <input id="download_url" type="url" name="download_url" value="{{ old('download_url', $software->download_url ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('download_url') border-red-500 @enderror">
            <p class="text-xs text-text-500 mt-1">{{ __('Only delivered to the buyer after payment is approved.') }}</p>
            @error('download_url')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="purchase_url" class="text-sm font-medium block mb-1">{{ __('Purchase URL') }}</label>
            <input id="purchase_url" type="url" name="purchase_url" value="{{ old('purchase_url', $software->purchase_url ?? '') }}"
                class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('purchase_url') border-red-500 @enderror">
            <p class="text-xs text-text-500 mt-1">{{ __('If set, the Buy button links here instead of using the internal checkout.') }}</p>
            @error('purchase_url')
                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

    </div>

    <div class="flex flex-wrap gap-x-8 gap-y-3 mt-6 pt-6 border-t border-variant-100">
        @php
            $requiresQuote = old('requires_quote', $software->requires_quote ?? false);
            $active = old('active', $software->active ?? true);
            $featured = old('featured', $software->featured ?? false);
        @endphp

        <label class="flex items-center gap-x-2 text-sm cursor-pointer">
            <input type="checkbox" name="requires_quote" value="1" {{ $requiresQuote ? 'checked' : '' }}
                class="w-4 h-4 rounded border-variant-100 text-accent-900 focus:ring-accent-900">
            {{ __('Requires quote') }}
        </label>

        <label class="flex items-center gap-x-2 text-sm cursor-pointer">
            <input type="checkbox" name="active" value="1" {{ $active ? 'checked' : '' }}
                class="w-4 h-4 rounded border-variant-100 text-accent-900 focus:ring-accent-900">
            {{ __('Active') }}
        </label>

        <label class="flex items-center gap-x-2 text-sm cursor-pointer">
            <input type="checkbox" name="featured" value="1" {{ $featured ? 'checked' : '' }}
                class="w-4 h-4 rounded border-variant-100 text-accent-900 focus:ring-accent-900">
            {{ __('Featured') }}
        </label>
    </div>

</div>
