@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Ventas')

@php
    $statusBadgeClasses = [
        'approved' => 'bg-green-100 text-green-700',
        'pending' => 'bg-yellow-100 text-yellow-700',
        'in_process' => 'bg-yellow-100 text-yellow-700',
        'rejected' => 'bg-red-100 text-red-700',
        'cancelled' => 'bg-red-100 text-red-700',
        'refunded' => 'bg-variant-100/20 text-variant-100',
        'charged_back' => 'bg-red-100 text-red-700',
        'in_mediation' => 'bg-yellow-100 text-yellow-700',
    ];

    $statusLabels = [
        'approved' => 'approved',
        'pending' => 'pending',
        'in_process' => 'in process',
        'rejected' => 'rejected',
        'cancelled' => 'cancelled',
        'refunded' => 'refunded',
        'charged_back' => 'charged back',
        'in_mediation' => 'in mediation',
    ];
@endphp

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Sales') }}
                </h1>
            </div>
            <a href="{{ route('admin') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        {{-- Stat cards --}}
        <div class="flex flex-wrap gap-4 mb-10">

            <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-64">
                <div class="w-11 h-11 shrink-0 rounded-full bg-accent-300 flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap text-lg text-accent-900"></i>
                </div>
                <div>
                    <p class="text-xl font-bold text-text-900">${{ number_format($stats['coursesApprovedTotal'], 2, ',', '.') }}</p>
                    <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('courses revenue') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-64">
                <div class="w-11 h-11 shrink-0 rounded-full bg-accent2-300 flex items-center justify-center">
                    <i class="fa-solid fa-layer-group text-lg text-accent2-900"></i>
                </div>
                <div>
                    <p class="text-xl font-bold text-text-900">${{ number_format($stats['softwareApprovedTotal'], 2, ',', '.') }}</p>
                    <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('software revenue') }}</p>
                </div>
            </div>

            @if ($stats['coursesPendingCount'] > 0)
                <div class="flex items-center gap-x-4 bg-background-500 border border-yellow-500 shadow-2xs rounded-xl p-5 w-full sm:w-64">
                    <div class="w-11 h-11 shrink-0 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fa-solid fa-clock text-lg text-yellow-700"></i>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-yellow-700">{{ $stats['coursesPendingCount'] }}</p>
                        <p class="text-xs uppercase tracking-wide text-yellow-700">{{ __('pending course payments') }}</p>
                    </div>
                </div>
            @endif

            @if ($stats['softwarePendingCount'] > 0)
                <div class="flex items-center gap-x-4 bg-background-500 border border-yellow-500 shadow-2xs rounded-xl p-5 w-full sm:w-64">
                    <div class="w-11 h-11 shrink-0 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fa-solid fa-clock text-lg text-yellow-700"></i>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-yellow-700">{{ $stats['softwarePendingCount'] }}</p>
                        <p class="text-xs uppercase tracking-wide text-yellow-700">{{ __('pending software orders') }}</p>
                    </div>
                </div>
            @endif

        </div>

        {{-- Courses payments --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-three font-bold text-lg text-text-900">{{ __('Course payments') }}</h2>
        </div>

        <div class="flex flex-wrap gap-2 mb-4">
            @php $courseStatuses = ['pending' => 'pending', 'approved' => 'approved', 'rejected' => 'rejected', 'in_process' => 'in process', 'refunded' => 'refunded', 'cancelled' => 'cancelled']; @endphp
            <a href="{{ route('sales.index', array_filter(['software_status' => $softwareStatus])) }}"
               class="text-xs font-medium px-3 py-1.5 rounded-full border transition-colors duration-300
                      {{ !$courseStatus ? 'bg-accent-900 text-white border-accent-900' : 'border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900' }}">
                {{ __('all') }}
            </a>
            @foreach ($courseStatuses as $value => $label)
                <a href="{{ route('sales.index', array_filter(['course_status' => $value, 'software_status' => $softwareStatus])) }}"
                   class="text-xs font-medium px-3 py-1.5 rounded-full border transition-colors duration-300
                          {{ $courseStatus === $value ? 'bg-accent-900 text-white border-accent-900' : 'border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900' }}">
                    {{ __($label) }}
                </a>
            @endforeach
        </div>

        @if ($coursePayments->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10 mb-10">
                <i class="fa-solid fa-graduation-cap text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No course payments found.') }}</p>
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden overflow-x-auto mb-4">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-variant-100 text-left">
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Student') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Course') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Amount') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Status') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coursePayments as $payment)
                            <tr class="border-b border-variant-100 last:border-b-0">
                                <td class="p-4">
                                    <p class="font-bold text-text-900">{{ $payment->user->name ?? '—' }} {{ $payment->user->lastname ?? '' }}</p>
                                    <p class="text-xs text-text-500 lg:hidden">{{ $payment->course->name ?? '—' }}</p>
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $payment->course->name ?? '—' }}</td>
                                <td class="p-4 text-text-900 font-medium">${{ number_format($payment->amount, 2, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full {{ $statusBadgeClasses[$payment->status] ?? 'bg-background-300 text-text-500' }}">
                                        {{ __($statusLabels[$payment->status] ?? $payment->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $payment->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mb-10">
                {{ $coursePayments->links() }}
            </div>
        @endif

        {{-- Software orders --}}
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-three font-bold text-lg text-text-900">{{ __('Software orders') }}</h2>
        </div>

        <div class="flex flex-wrap gap-2 mb-4">
            @php $softwareStatuses = ['pending' => 'pending', 'approved' => 'approved', 'rejected' => 'rejected', 'in_process' => 'in process', 'refunded' => 'refunded', 'cancelled' => 'cancelled']; @endphp
            <a href="{{ route('sales.index', array_filter(['course_status' => $courseStatus])) }}"
               class="text-xs font-medium px-3 py-1.5 rounded-full border transition-colors duration-300
                      {{ !$softwareStatus ? 'bg-accent-900 text-white border-accent-900' : 'border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900' }}">
                {{ __('all') }}
            </a>
            @foreach ($softwareStatuses as $value => $label)
                <a href="{{ route('sales.index', array_filter(['software_status' => $value, 'course_status' => $courseStatus])) }}"
                   class="text-xs font-medium px-3 py-1.5 rounded-full border transition-colors duration-300
                          {{ $softwareStatus === $value ? 'bg-accent-900 text-white border-accent-900' : 'border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900' }}">
                    {{ __($label) }}
                </a>
            @endforeach
        </div>

        @if ($softwareOrders->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-layer-group text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No software orders found.') }}</p>
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-variant-100 text-left">
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Customer') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Items') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Total') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Status') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Date') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($softwareOrders as $order)
                            <tr class="border-b border-variant-100 last:border-b-0">
                                <td class="p-4">
                                    <p class="font-bold text-text-900">{{ $order->user->name ?? '—' }} {{ $order->user->lastname ?? '' }}</p>
                                    <p class="text-xs text-text-500 lg:hidden">{{ $order->items->pluck('name')->join(', ') }}</p>
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $order->items->pluck('name')->join(', ') }}</td>
                                <td class="p-4 text-text-900 font-medium">${{ number_format($order->total, 2, ',', '.') }}</td>
                                <td class="p-4">
                                    <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full {{ $statusBadgeClasses[$order->status] ?? 'bg-background-300 text-text-500' }}">
                                        {{ __($statusLabels[$order->status] ?? $order->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6">
                {{ $softwareOrders->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
