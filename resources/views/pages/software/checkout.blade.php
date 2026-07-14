@extends('components.layout.layout')

@section('title', 'Code & Lens - Checkout')

@section('content')

<div class="flex flex-col items-center w-full">
    <div class="w-full max-w-2xl px-4 lg:px-0 py-10">

        <div class="flex items-center gap-x-2 text-xs text-variant-100 font-five uppercase tracking-wide mb-8">
            <a href="{{ route('software.catalog') }}" class="hover:underline">{{ __('Software') }}</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <a href="{{ route('software.show', $software->id) }}" class="hover:underline">{{ $software->name }}</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-text-500 normal-case tracking-normal">{{ __('Checkout') }}</span>
        </div>

        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8">

            <h1 class="font-three font-bold text-2xl text-text-900 mb-1">{{ __('Checkout') }}</h1>
            <p class="text-sm text-variant-100 mb-6">{{ __('Review your order and pay securely with Mercado Pago') }}</p>

            {{-- Product summary --}}
            <div class="flex items-center gap-x-4 border-b border-variant-100 pb-6 mb-6">
                @if ($software->image)
                    <img src="{{ asset('storage/software/'.$software->image) }}" alt="{{ $software->name }}" class="w-16 h-16 rounded-lg object-cover border border-variant-100">
                @else
                    <div class="w-16 h-16 rounded-lg bg-accent2-300 flex items-center justify-center">
                        <i class="fa-solid fa-cube text-accent2-900"></i>
                    </div>
                @endif
                <div class="flex-1">
                    <p class="font-bold text-text-900">{{ $software->name }}</p>
                    @if ($software->short_description)
                        <p class="text-sm text-text-500">{{ $software->short_description }}</p>
                    @endif
                </div>
                <p class="font-semibold text-text-900" id="basePriceLabel" data-price="{{ (float) $software->price }}">
                    ${{ number_format($software->price, 2, ',', '.') }}
                </p>
            </div>

            {{-- Addons --}}
            @if ($availableAddons->isNotEmpty())
                <div class="mb-6">
                    <p class="text-xs uppercase tracking-wide text-variant-100 font-medium mb-3">{{ __('Optional add-ons') }}</p>
                    <div class="space-y-2">
                        @foreach ($availableAddons as $addon)
                            <label class="flex items-center justify-between gap-x-3 p-3 rounded-lg border border-variant-100 cursor-pointer hover:bg-background-300 transition-colors duration-300">
                                <span class="flex items-center gap-x-3">
                                    <input type="checkbox"
                                           class="addon-checkbox w-4 h-4 rounded border-variant-100 text-accent-900 focus:ring-accent-900"
                                           value="{{ $addon->id }}"
                                           data-price="{{ (float) $addon->price }}"
                                           {{ in_array($addon->id, $addonIds->all()) ? 'checked' : '' }}>
                                    <span>
                                        <span class="block text-sm font-medium text-text-900">{{ $addon->name }}</span>
                                        @if ($addon->description)
                                            <span class="block text-xs text-text-500">{{ $addon->description }}</span>
                                        @endif
                                    </span>
                                </span>
                                <span class="text-sm font-medium text-text-900 whitespace-nowrap">
                                    ${{ number_format($addon->price, 2, ',', '.') }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- Total --}}
            <div class="flex items-center justify-between border-t border-variant-100 pt-6 mb-6">
                <span class="font-three font-bold text-lg text-text-900">{{ __('Total') }}</span>
                <span class="font-three font-bold text-2xl text-text-900" id="totalLabel">
                    ${{ number_format($total, 2, ',', '.') }}
                </span>
            </div>

            {{-- Payment --}}
            <div id="loading" class="text-center text-sm text-text-500 py-6">
                {{ __('Preparing payment...') }}
            </div>
            <div id="walletBrick_container"></div>
            <div id="paymentError" class="hidden text-sm text-red-600 bg-red-50 rounded-lg p-3 mt-3"></div>

        </div>
    </div>
</div>

<script src="https://sdk.mercadopago.com/js/v2"></script>
<script>
    const mp = new MercadoPago("{{ config('services.mercadopago.public_key') }}", {
        locale: 'es-AR'
    });

    const softwareId = {{ $software->id }};
    const basePrice = parseFloat(document.getElementById('basePriceLabel').dataset.price);
    const totalLabel = document.getElementById('totalLabel');
    const checkboxes = document.querySelectorAll('.addon-checkbox');
    let brickController = null;

    function formatARS(value) {
        return '$' + value.toLocaleString('es-AR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function selectedAddonIds() {
        return Array.from(checkboxes).filter(cb => cb.checked).map(cb => parseInt(cb.value, 10));
    }

    function recomputeTotal() {
        let total = basePrice;
        checkboxes.forEach(cb => {
            if (cb.checked) total += parseFloat(cb.dataset.price);
        });
        totalLabel.textContent = formatARS(total);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', () => {
        recomputeTotal();
        renderPaymentBrick();
    }));

    function renderPaymentBrick() {
        document.getElementById('paymentError').classList.add('hidden');
        document.getElementById('loading').classList.remove('hidden');

        if (brickController) {
            brickController.unmount();
            brickController = null;
        }
        document.getElementById('walletBrick_container').innerHTML = '';

        fetch('{{ route('software.checkout.process') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                software_id: softwareId,
                addons: selectedAddonIds()
            })
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.message || '{{ __('Error creating the payment preference') }}');
                });
            }
            return response.json();
        })
        .then(data => {
            if (!data.success || !data.preference_id) {
                throw new Error('{{ __('Could not start the payment') }}');
            }

            document.getElementById('loading').classList.add('hidden');

            const bricksBuilder = mp.bricks();
            bricksBuilder.create("wallet", "walletBrick_container", {
                initialization: {
                    preferenceId: data.preference_id,
                },
                customization: {
                    texts: {
                        valueProp: 'smart_option',
                    },
                },
            }).then((controller) => {
                brickController = controller;
            }).catch(() => {
                document.getElementById('paymentError').textContent = '{{ __('Error loading the payment button. Please reload the page.') }}';
                document.getElementById('paymentError').classList.remove('hidden');
            });
        })
        .catch(error => {
            document.getElementById('loading').classList.add('hidden');
            document.getElementById('paymentError').textContent = error.message;
            document.getElementById('paymentError').classList.remove('hidden');
        });
    }

    renderPaymentBrick();
</script>

@endsection
