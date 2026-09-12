@extends('layouts.app')

@section('title', __('Prices') . ' - HealthCare')

@section('content')

<div class="row mb-4 align-items-center">
    <div class="col">
        <h2 class="fw-bold text-dark mb-0">
            <i class="bi bi-currency-dollar me-2 text-primary"></i>{{ __('Prices') }}
        </h2>
        <p class="text-muted mb-0 mt-1">{{ __('Financial summary across all patients') }}</p>
    </div>
    <div class="col-auto">
        <div class="card border-0 bg-primary text-white shadow-sm px-4 py-3">
            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-cash-stack fs-2"></i>
                <div>
                    <div class="small opacity-75">{{ __('Grand Total') }}</div>
                    <div class="fs-4 fw-bold">{{ number_format($grandTotal, 2) }} {{ __('EGP') }}</div>
                    <div class="small opacity-75">{{ $totalPatients }} {{ __('patients') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Section Totals --}}
<div class="bg-white rounded-3 shadow-sm border p-4 mb-4">
    <h5 class="fw-semibold text-secondary mb-4 pb-2 border-bottom">
        <i class="bi bi-building me-2 text-primary"></i>{{ __('By Section') }}
    </h5>
    <div class="row g-4">
        @php
            $sectionColors = ['agamy' => 'success', 'dekhila' => 'info'];
            $sectionIcons  = ['agamy' => 'bi-pin-map-fill', 'dekhila' => 'bi-geo-alt-fill'];
        @endphp
        @foreach($sectionTotals as $key => $data)
        @php $color = $sectionColors[$key] ?? 'primary'; @endphp
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0" style="border-top: 4px solid var(--bs-{{ $color }}) !important;">
                <div class="card-header bg-{{ $color }} bg-opacity-10 border-0 d-flex align-items-center gap-3 py-3">
                    <div class="rounded-circle bg-{{ $color }} d-flex align-items-center justify-content-center text-white flex-shrink-0"
                         style="width:44px;height:44px;">
                        <i class="bi {{ $sectionIcons[$key] ?? 'bi-building' }} fs-5"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5 lh-1" dir="rtl">{{ $data['label'] }}</div>
                        <div class="text-muted small mt-1">{{ $data['count'] }} {{ __('patients') }}</div>
                    </div>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="text-muted small mb-1">{{ __('Total Revenue') }}</div>
                    <div class="fw-bold display-6 text-{{ $color }} lh-1">
                        {{ number_format($data['total'], 2) }}
                        <span class="fs-6 fw-normal text-muted ms-1">{{ __('EGP') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<hr class="my-4 border-2 opacity-25">

{{-- Source of Money Totals --}}
<div class="bg-white rounded-3 shadow-sm border p-4 mb-4">
    <h5 class="fw-semibold text-secondary mb-4 pb-2 border-bottom">
        <i class="bi bi-wallet2 me-2 text-primary"></i>{{ __('By Source of Money') }}
    </h5>
    <div class="row g-4">
        @php
            $sourceColors = ['charity' => 'warning', 'country' => 'danger'];
            $sourceIcons  = ['charity' => 'bi-heart-fill', 'country' => 'bi-flag-fill'];
        @endphp
        @foreach($sourceTotals as $key => $data)
        @php $color = $sourceColors[$key] ?? 'secondary'; @endphp
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0" style="border-top: 4px solid var(--bs-{{ $color }}) !important;">
                <div class="card-header bg-{{ $color }} bg-opacity-10 border-0 d-flex align-items-center gap-3 py-3">
                    <div class="rounded-circle bg-{{ $color }} d-flex align-items-center justify-content-center text-white flex-shrink-0"
                         style="width:44px;height:44px;">
                        <i class="bi {{ $sourceIcons[$key] ?? 'bi-cash-coin' }} fs-5"></i>
                    </div>
                    <div>
                        <div class="fw-bold fs-5 lh-1" dir="rtl">{{ $data['label'] }}</div>
                        <div class="text-muted small mt-1">{{ $data['count'] }} {{ __('patients') }}</div>
                    </div>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="text-muted small mb-1">{{ __('Total Revenue') }}</div>
                    <div class="fw-bold display-6 text-{{ $color }} lh-1">
                        {{ number_format($data['total'], 2) }}
                        <span class="fs-6 fw-normal text-muted ms-1">{{ __('EGP') }}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
