@extends('layout')
@section('title')
  <title>{{ __('admin.Subscription') }}</title>
  <meta name="keywords" content="{{ __('admin.Subscription') }}">
  <meta name="title" content="{{ __('admin.Subscription') }}">
  <meta name="description" content="{{ __('admin.Subscription') }}">
@endsection
@section('frontend-content')
  <!-- Breadcrumbs -->
  <section class="inflanar-breadcrumb" style="background-image: url({{ asset($breadcrumb) }});">
    <div class="container">
      <div class="row">
        <!-- Breadcrumb-Content -->
        <div class="col-12">
          <div class="inflanar-breadcrumb__inner">
            <div class="inflanar-breadcrumb__content">
              <h2 class="inflanar-breadcrumb__title m-0">{{ __('admin.Subscription Plan') }}</h2>
              <ul class="inflanar-breadcrumb__menu list-none">
                <li><a href="{{ route('home') }}">{{ __('admin.Home') }}</a></li>
                <li class="active"><a href="javascript:;">{{ __('admin.Subscription Plan') }}</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End breadcrumbs -->
  <!-- Subscription Plan -->
  <section class="pd-top-120 pd-btm-120">
    <div class="max-w-[1240px] mx-auto">
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-12">
              <!-- Section TItle -->
              <div class="inflanar-section__head inflanar-section__center mg-btm-20">
                <span class="inflanar-section__badge inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
                  <span>{{ __('admin.Subscription') }}</span> <img
                    src="{{ asset('frontend/img/in-section-vector2.svg') }}">
                </span>
                <h2 class="inflanar-section__title" data-aos="fade-in" data-aos-delay="400">
                  {{ __('admin.Subscription Plan') }}</h2>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="container mt-5">
        <!-- Nav Pills for Monthly and Yearly -->
        <ul class="nav nav-pills mb-8 justify-center gap-2" id="pills-tab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active pricing-tab" id="pills-monthly-tab" data-bs-toggle="pill" data-bs-target="#pills-monthly" type="button" role="tab" aria-controls="pills-monthly" aria-selected="true">Monthly</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link pricing-tab" id="pills-yearly-tab" data-bs-toggle="pill" data-bs-target="#pills-yearly" type="button" role="tab" aria-controls="pills-yearly" aria-selected="false">Yearly</button>
          </li>
        </ul>
      
        <!-- Tab Content -->
        <div class="tab-content" id="pills-tabContent">
          <!-- Monthly Plans -->
          <div class="tab-pane fade show active" id="pills-monthly" role="tabpanel" aria-labelledby="pills-monthly-tab">
            <div class="row">
              @foreach ($plans as $plan)
                @if ($plan->expiration_date == 'monthly')
                  <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="pricing-pack highlighted flex flex-column h-full">
                      <div class="price-header-wrapper">
                        <div class="position-relative price-header d-flex justify-content-center flex-column align-items-center">
                          <h4 class="pack-name">{{ $plan->plan_name }}</h4>
                          <div class="price-circle">
                            <p class="m-0 pack-price">
                              {{ $setting->currency_icon }}{{ $plan->plan_price }}
                              <br>
                              <span class="pack-duration uppercase">
                                {{ $plan->expiration_date }}
                              </span>
                            </p>
                          </div>
                        </div>
                        <svg class="price-shape" width="307" height="193" viewBox="0 0 307 193" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M45.8004 119.05C64.0918 119.05 80.3605 130.217 87.4876 147.093C98.72 173.677 124.991 192.33 155.622 192.33C186.254 192.33 212.05 173.083 223.28 146.499C230.41 129.624 240.225 119.05 265.442 119.05L362.825 119.05L362.825 -0.00178528L-55.811 -0.00182188L-55.811 119.05L45.8004 119.05Z"
                            fill="#FE2C55" />
                        </svg>
                      </div>
                      <div class="pack-content d-flex flex-column align-items-center">
                        {!! $plan->features !!}
                        <span class="non-features">
                          {!! $plan->non_features !!}
                        </span>
                      </div>
                      <div class="pack-btn-wrapper mt-auto">
                        @if ($plan->plan_price == 0)
                          <a class="pack-action-btn highlighted-btn"
                            href="{{ route('subscription.free-enroll', $plan->id) }}">Get Started</a>
                        @else
                          <a class="pack-action-btn highlighted-btn"
                            href="{{ route('subscription-payment', $plan->id) }}">Get Started</a>
                        @endif
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
      
          <!-- Yearly Plans -->
          <div class="tab-pane fade" id="pills-yearly" role="tabpanel" aria-labelledby="pills-yearly-tab">
            <div class="row">
              @foreach ($plans as $plan)
                @if ($plan->expiration_date == 'yearly')
                  <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <div class="pricing-pack highlighted flex flex-column h-full">
                      <div class="price-header-wrapper">
                        <div class="position-relative price-header d-flex justify-content-center flex-column align-items-center">
                          <h4 class="pack-name">{{ $plan->plan_name }}</h4>
                          <div class="price-circle">
                            <p class="m-0 pack-price">
                              {{ $setting->currency_icon }}{{ $plan->plan_price }}
                              <br>
                              <span class="pack-duration uppercase">
                                {{ $plan->expiration_date }}
                              </span>
                            </p>
                          </div>
                        </div>
                        <svg class="price-shape" width="307" height="193" viewBox="0 0 307 193" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M45.8004 119.05C64.0918 119.05 80.3605 130.217 87.4876 147.093C98.72 173.677 124.991 192.33 155.622 192.33C186.254 192.33 212.05 173.083 223.28 146.499C230.41 129.624 240.225 119.05 265.442 119.05L362.825 119.05L362.825 -0.00178528L-55.811 -0.00182188L-55.811 119.05L45.8004 119.05Z"
                            fill="#FE2C55" />
                        </svg>
                      </div>
                      <div class="pack-content d-flex flex-column align-items-center">
                        {!! $plan->features !!}
                        <span class="non-features">
                          {!! $plan->non_features !!}
                        </span>
                      </div>
                      <div class="pack-btn-wrapper mt-auto">
                        @if ($plan->plan_price == 0)
                          <a class="pack-action-btn highlighted-btn"
                            href="{{ route('subscription.free-enroll', $plan->id) }}">Get Started</a>
                        @else
                          <a class="pack-action-btn highlighted-btn"
                            href="{{ route('subscription-payment', $plan->id) }}">Get Started</a>
                        @endif
                      </div>
                    </div>
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <!-- Subscription Plan End-->
@endsection
