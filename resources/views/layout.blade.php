<!DOCTYPE html>
<html class="no-js" lang="ZXX">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @yield('title')

  <!-- Fav Icon -->
  <link rel="icon" href="{{ asset($setting->favicon) }}">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap"
    rel="stylesheet">
  {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> --}}
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
  <!-- Jquery UI CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
  <!-- Animate CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
  <!-- AOS CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/aos.min.css') }}">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome-all.min.css') }}">
  <!-- Swiper Slider CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/swiper-slider.min.css') }}">
  <!-- Select2 CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/select2-min.css') }}">
  <!-- Data Tables -->
  <link rel="stylesheet" href="{{ asset('frontend/css/datatables.min.css') }}">
  <!-- Video Popup -->
  <link rel="stylesheet" href="{{ asset('frontend/css/video-popup.min.css') }}">

  <!-- Main CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/theme-default.css') }}">


  @if (Session::get('lang_dir'))
    @if (Session::get('lang_dir') == 'right_to_left')
      <link rel="stylesheet" href="{{ asset('frontend/rtl.css') }}">
    @else
      <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
    @endif
  @else
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
  @endif

  <link rel="stylesheet" href="{{ asset('frontend/css/live_chat.css') }}">

  <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}">

  <!-- Lightbox CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/glightbox.min.css') }}" />

  <script src="{{ asset('frontend/js/jquery-3.7.1.min.js') }}"></script>
  <script src="{{ asset('frontend/js/sweetalert2@11.js') }}"></script>
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script src="{{ asset('frontend/js/flatpickr.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/custom.css') }}">

  @if ($google_analytic->status == 1)
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $google_analytic->analytic_id }}"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', '{{ $google_analytic->analytic_id }}');
    </script>
  @endif

  @if ($facebook_pixel->status == 1)
    <script>
      ! function(f, b, e, v, n, t, s) {
        if (f.fbq) return;
        n = f.fbq = function() {
          n.callMethod ?
            n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
      }(window, document, 'script',
        'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '{{ $facebook_pixel->app_id }}');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id={{ $facebook_pixel->app_id }}&ev=PageView&noscript=1" /></noscript>
  @endif

  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<style>
  .responsive-links {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
  }

  .responsive-links a {
    margin: 5px;
  }

  @media (max-width: 600px) {
    .responsive-links a {
      width: 100%;
      text-align: center;
    }
  }
</style>

@if (Session::get('lang_dir'))
  @if (Session::get('lang_dir') == 'right_to_left')

    <body class="rtl-theme" id="app">
    @else

      <body id="app">
  @endif
@else

  <body id="app">
@endif

@if ($setting->preloader_status == 'enable')
  <div id="loading">
    <div id="loading-center">
      <div id="loading-center-absolute">
        <div class="object" id="object_one"></div>
        <div class="object" id="object_two"></div>
        <div class="object" id="object_three"></div>
        <div class="object" id="object_four"></div>
        <div class="object" id="object_five"></div>
      </div>
    </div>
  </div>
@endif
<!-- End Preloader -->

<!-- Mobile Menu Modal -->
<div class="modal offcanvas-modal inflanar-mobile-menu fade" id="offcanvas-modal">
  <div class="modal-dialog offcanvas-dialog">
    <div class="modal-content">
      <div class="modal-header offcanvas-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          <i class="fas fa-remove"></i>
        </button>
      </div>
      <!-- offcanvas-logo-start -->
      <div class="offcanvas-logo">
        <a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="#"></a>
      </div>
      <!-- offcanvas-logo-end -->
      <!-- offcanvas-menu start -->
      <nav id="offcanvas-menu" class="offcanvas-menu">
        <!-- Main Menu -->
        <ul class="nav-menu menu navigation list-none">
          <li><a href="/">Home</a></li>
          <li><a href="{{ route('search.index') }}">Search</a></li>
          <li><a href="/#how-it-works">How it works</a></li>
          <li><a href="{{ route('pricing-plan') }}">Pricing</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
          @guest('web')
            <a href="{{ route('login') }}" class="text-[#F7BEA4] font-semibold block text-center border !border-main py-2 rounded-lg mb-2 mt-5"><span>
                Join as Brand</span></a>
            <a href="{{ route('login') }}" class="text-[#F7BEA4] font-semibold block text-center border !border-main py-2 rounded-lg"><span>
                Join as Influencer</span></a>
          @else
            @php
              $auth_user = Auth::guard('web')->user();
            @endphp
            @if ($auth_user->is_influencer == 'yes')
              <a href="{{ route('influencer.dashboard') }}"
                class="inflanar-btn inflanar-btn--header"><span>{{ __('admin.Dashboard') }}</span></a>
            @else
              <a href="{{ route('user.dashboard') }}"
                class="inflanar-btn inflanar-btn--header"><span>{{ __('admin.Dashboard') }}</span></a>
            @endif
          @endguest
        </ul>
        <!-- End Main Menu -->
      </nav>
      <!-- offcanvas-menu end -->

    </div>
  </div>
</div>
<!-- End Mobile Menu Modal -->

<!-- Header -->
<header id="active-sticky" class="inflanar-header  {{ Route::is('home') ? '' : 'inflanar-header__v2' }}">
  <div class="inflanar-header__middle">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="py-3 relative">
            <div class="justify-between">
              <div class="inflanar-header__logo">
                <a href="{{ route('home') }}"><img src="{{ asset($setting->logo) }}" alt="#"></a>
              </div>
              <div class="inflanar-header__menu">
                <div class="navbar">
                  <div class="nav-item">
                    <!-- Main Menu -->
                    <ul class="nav-menu menu navigation list-none font-agrandir">
                      <li><a href="{{ route('search.index') }}">Search</a>
                      </li>
                      <li><a href="/#how-it-works">How it Works</a>
                      </li>
                      <li><a href="{{ route('pricing-plan') }}">Pricing</a>
                      </li>
                      <li><a href="{{ route('login') }}">Login</a>
                      </li>
                      @guest('web')
                        <a href="{{ route('login') }}" class="me-3 text-[#F7BEA4] font-semibold"><span>
                            Join as Brand</span></a>
                        <a href="{{ route('login') }}" class="text-[#F7BEA4] font-semibold"><span>
                            Join as Influencer</span></a>
                      @else
                        @php
                          $auth_user = Auth::guard('web')->user();
                        @endphp
                        @if ($auth_user->is_influencer == 'yes')
                          <a href="{{ route('influencer.dashboard') }}"
                            class="inflanar-btn inflanar-btn--header"><span>{{ __('admin.Dashboard') }}</span></a>
                        @else
                          <a href="{{ route('user.dashboard') }}"
                            class="inflanar-btn inflanar-btn--header"><span>{{ __('admin.Dashboard') }}</span></a>
                        @endif
                      @endguest
                      {{-- <li><a href="{{ route('influencers') }}">{{ __('admin.Influencers') }}</a></li>

                      <li><a href="{{ route('services') }}">{{ __('admin.Services') }}</a></li>

                      <li class="menu-item-has-children"><a href="#">{{ __('admin.Pages') }}</a>
                        <ul class="sub-menu">

                          @if ($setting->commission_type == 'subscription')
                            @php
                              $json_module_data = file_get_contents(base_path('modules_statuses.json'));
                              $module_status = json_decode($json_module_data);
                            @endphp

                            @if ($module_status->Subscription)
                              <li>
                                <a class="{{ Route::is('pricing-plan') ? 'active' : '' }}"
                                  href="{{ route('pricing-plan') }}">{{ __('admin.Subscription') }}</a>
                              </li>
                            @endif
                          @endif

                          <li><a href="{{ route('about-us') }}">{{ __('admin.About Us') }}</a></li>

                          <li><a href="{{ route('blogs') }}">{{ __('admin.Our Blogs') }}</a></li>
                          <li><a href="{{ route('faq') }}">{{ __('admin.FAQ') }}</a></li>
                          <li><a href="{{ route('terms-conditions') }}">{{ __('admin.Terms & Conditions') }}</a></li>
                          <li><a href="{{ route('privacy-policy') }}">{{ __('admin.Privacy Policy') }}</a></li>
                          @foreach ($custom_pages as $custom_page)
                            <li><a
                                href="{{ route('custom-page', $custom_page->slug) }}">{{ $custom_page->page_name }}</a>
                            </li>
                          @endforeach
                        </ul>
                      </li> --}}
                      {{-- <li><a href="{{ route('contact-us') }}">{{ __('admin.Contact') }}</a></li> --}}
                    </ul>
                    <!-- End Main Menu -->
                  </div>
                </div>
              </div>
            </div>
            <button type="button" class="offcanvas-toggler" data-bs-toggle="modal"
              data-bs-target="#offcanvas-modal"><span class="line"></span><span class="line"></span><span
                class="line"></span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</header>
<!-- End Header -->

@yield('frontend-content')

<!-- Footer -->
<footer class="footer-area pt-20 bg-main">
  <div class="container">
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 pb-16">
      <div class="single-widget footer-useful-links">
        <h3 class="font-semibold text-black mb-2 text-xl">Resources</h3>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Blog</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Resource Hub</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Affiliate Program</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">TikTok Ebook For Brands</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">2025 Influencer Marketing Report</a>
          </li>
        </ul>
      </div>
      <div class="single-widget footer-useful-links">
        <h3 class="font-semibold text-black mb-2 text-xl">Tools</h3>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Influencer Price Calculator</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Instagram Fake Follower Checker</a>
          </li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">TikTok Fake Follower Checker</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Instagram Engagement Rate
              Calculator</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">TikTok Engagement Rate Calculator</a>
          </li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Influencer Campaign Brief Template</a>
          </li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Influencer Contract Template</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Influencer Analytics & Tracking</a>
          </li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Instagram Reels Downloader</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">TikTok Video Downloader</a></li>
        </ul>
      </div>
      <div class="single-widget footer-useful-links">
        <h3 class="font-semibold text-black mb-2 text-xl">Discover</h3>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Find Influencers</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Top Influencers</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Search Influencers</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Buy Shoutouts</a></li>
        </ul>
      </div>
      <div class="single-widget footer-useful-links">
        <h3 class="font-semibold text-black mb-2 text-xl">Support</h3>
        <ul class="flex flex-col gap-2">
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Contact Us</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">How It Works</a></li>
          <li><a href="#" class="text-sm !text-[rgba(255,255,255,0.41)]">Frequently Asked Questions</a></li>
        </ul>
      </div>
    </div>
  </div>
  <!-- Copyright -->
  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="copyright__inner">
            <!-- Copyright Text -->
            <p class="copyright-text !text-[12px] font-normal font-agrandir !text-black">{{ $setting->copyright }}</p>
            <!-- Social -->
            <ul class="inflanar-social inflanar-social__v2">
              @if ($setting->twitter)
                <li><a href="{{ $setting->twitter }}"><i class="fa-brands fa-twitter"></i></a></li>
              @endif

              @if ($setting->behance)
                <li><a href="{{ $setting->behance }}"><i class="fa-brands fa-behance"></i></a></li>
              @endif

              @if ($setting->instagram)
                <li><a href="{{ $setting->instagram }}"><i class="fa-brands fa-instagram"></i></a></li>
              @endif

              @if ($setting->linkedin)
                <li><a href="{{ $setting->linkedin }}"><i class="fa-brands fa-linkedin"></i></a></li>
              @endif

              @if ($setting->facebook)
                <li><a href="{{ $setting->facebook }}"><i class="fa-brands fa-facebook-f"></i></a></li>
              @endif

            </ul>
            <!-- End Social -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Copyright -->
</footer>
<!-- End Footer -->

@auth('web')
  <button class="wsus__message__button inflanar-btn inflanar-btn--header custom-message-icon">
    <span><img src="{{ asset('uploads/website-images/chat_icon.png') }}" alt="chat"
        class="img-fluid w-100"></span>
    {{ __('admin.Live Chat') }}
  </button>
@else
  <button class="wsus__message__button inflanar-btn inflanar-btn--header custom-message-icon"
    onclick="sendNewMessagePrevLogin()">
    <span><img src="{{ asset('uploads/website-images/chat_icon.png') }}" alt="chat"
        class="img-fluid w-100"></span>
    {{ __('admin.Live Chat') }}
  </button>
@endauth



{{-- start message area --}}
@auth('web')
  <div class="wsus__message_area">
    <p class="heading">
      <span><img src="{{ asset('uploads/website-images/chat_icon.png') }}" alt="chat"
          class="img-fluid w-100"></span>
      {{ __('admin.Live Chat') }}
      <a class="close_chat"><i class="fa fa-times-circle"></i></a>
    </p>

    <div class="wsus__main_message">
      <div class="wsus__message_list">
        <ul id="provider_existing_list">

          @php
            $login_buyer = Auth::guard('web')->user();

            $providers = App\Models\Message::with('provider')
                ->where(['buyer_id' => $login_buyer->id])
                ->select('provider_id')
                ->groupBy('provider_id')
                ->orderBy('id', 'desc')
                ->get();

            $setting = App\Models\Setting::first();
            $default_avatar = (object) [
                'image' => $setting->default_avatar,
            ];
          @endphp

          @foreach ($providers as $provider)
            <li class="provider-list single-provider-{{ $provider->provider_id }}"
              data-provider-id="{{ $provider->provider_id }}" onclick="loadChatBox({{ $provider->provider_id }})">
              <div class="img">
                @if ($provider->provider->image)
                  <img src="{{ asset($provider->provider->image) }}" alt="user" class="img-fluid w-100">
                @else
                  <img src="{{ asset($default_avatar->image) }}" alt="user" class="img-fluid w-100">
                @endif

                @php
                  $un_read = App\Models\Message::where([
                      'provider_id' => $provider->provider_id,
                      'buyer_id' => $login_buyer->id,
                      'buyer_read_msg' => 0,
                  ])->count();
                @endphp

                <span id="pending-{{ $provider->provider_id }}"
                  class="{{ $un_read == 0 ? 'd-none' : '' }}">{{ $un_read }}</span>
              </div>
              <div class="text">
                <h3>{{ $provider->provider->name }}</h3>
                <p>{{ $provider->provider->designation }}</p>
              </div>
            </li>
          @endforeach
        </ul>
      </div>
      <div class="wsus__message_box">

        <div class="wsus__empty_message">
          <div class="img">
            <img src="{{ asset('uploads/website-images/empty_chat.png') }}" alt="empty" class="img-fluid w-100">
          </div>
          <h3>{{ __('admin.No Message yet!') }}</h3>
          <p>{{ __('admin.Please choose one') }}</p>
        </div>

        <div class="wsus__message_preloader d-none">
          <span>
            <img src="{{ asset('uploads/website-images/preloader.gif') }}" alt="preloader" class="img-fluid w-100">
          </span>
        </div>

        <div class="wsus__message_box_text d-none">

        </div>
        <form id="chat-form">
          @csrf
          <input type="text" name="message" placeholder="{{ __('admin.Type message') }}" id="provider_message"
            autocomplete="off">
          <input type="hidden" name="provider_id" id="message_provider_id">
          <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </form>
      </div>
    </div>
  </div>
@endauth
{{-- end message area --}}

<!-- Scrool Top -->
{{-- <a href="#" class="scrollToTop"><img src="{{ asset('frontend/img/in-scroll-up.svg') }}"></a> --}}


@if ($tawk_chat->status == 1)
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = '{{ $tawk_chat->chat_link }}';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
@endif

@if ($cookie_consent->status == 1)
  <script src="{{ asset('frontend/js/cookieconsent.min.js') }}"></script>

  <script>
    window.addEventListener("load", function() {
      window.wpcc.init({
        "border": "{{ $cookie_consent->border }}",
        "corners": "{{ $cookie_consent->corners }}",
        "colors": {
          "popup": {
            "background": "{{ $cookie_consent->background_color }}",
            "text": "{{ $cookie_consent->text_color }} !important",
            "border": "{{ $cookie_consent->border_color }}"
          },
          "button": {
            "background": "{{ $cookie_consent->btn_bg_color }}",
            "text": "{{ $cookie_consent->btn_text_color }}"
          }
        },
        "content": {
          "href": "{{ route('privacy-policy') }}",
          "message": "{{ $cookie_consent->message }}",
          "link": "{{ $cookie_consent->link_text }}",
          "button": "{{ $cookie_consent->btn_text }}"
        }
      })
    });
  </script>
@endif

<!-- Jquery JS -->

<script src="{{ asset('frontend/js/jquery-migrate.js') }}"></script>
<script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
<!-- Bootstrap JS -->
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<!-- Aos JS -->
<script src="{{ asset('frontend/js/aos.min.js') }}"></script>
<!-- CK Editor JS -->
<script src="{{ asset('frontend/js/ckeditor.min.js') }}"></script>
<!-- Full Calendar JS -->
<script src="{{ asset('frontend/js/fullcalendar.min.js') }}"></script>
<!-- Select2 JS-->
<script src="{{ asset('frontend/js/select2-js.min.js') }}"></script>
<!-- Video Popup JS -->
<script src="{{ asset('frontend/js/video-popup.min.js') }}"></script>
<!-- Swiper SLider JS -->
<script src="{{ asset('frontend/js/swiper-slider.min.js') }}"></script>
<!-- Waypoints JS -->
<script src="{{ asset('frontend/js/waypoints.min.js') }}"></script>
<!-- Counterup JS -->
<script src="{{ asset('frontend/js/jquery.counterup.min.js') }}"></script>
<!-- Main JS -->
<script src="{{ asset('frontend/js/active.js') }}"></script>

<script src="{{ asset('toastr/toastr.min.js') }}"></script>

<!-- Lightbox -->
<script src="{{ asset('frontend/js/glightbox.min.js') }}"></script>

<script>
  // Lightbox Gallery
  var lightboxGallery = GLightbox({
    selector: ".portfolio-item",
    touchNavigation: true,
    loop: true,
  });
</script>

<script>
  @if (Session::has('messege'))
    var type = "{{ Session::get('alert-type', 'info') }}"
    switch (type) {
      case 'info':
        toastr.info("{{ Session::get('messege') }}");
        break;
      case 'success':
        toastr.success("{{ Session::get('messege') }}");
        break;
      case 'warning':
        toastr.warning("{{ Session::get('messege') }}");
        break;
      case 'error':
        toastr.error("{{ Session::get('messege') }}");
        break;
    }
  @endif
</script>

@if ($errors->any())
  @foreach ($errors->all() as $error)
    <script>
      toastr.error('{{ $error }}');
    </script>
  @endforeach
@endif

<script>
  "use strict";
  /* Testimonial Slider */
  var swiper = new Swiper(".inflanar-slider-testimonial", {
    autoplay: {
      delay: 3333500,
    },
    mousewheel: true,
    keyboard: true,
    loop: true,
    grabCursor: true,
    spaceBetween: 0,
    centeredSlides: false,
    pagination: {
      el: '.swiper-pagination__testimonial',
      type: 'bullets',
      clickable: true,
    },
    breakpoints: {
      320: {
        slidesPerView: "1",
      },
      428: {
        slidesPerView: "1",
      },
      768: {
        slidesPerView: "1",
      },
      1024: {
        slidesPerView: "2",
      },
    },
  });
</script>

<script>
  (function($) {
    "use strict";
    $(document).ready(function() {

      $(".add_to_wishlist").on('click', function(e) {
        e.preventDefault();

        var isDemo = "{{ env('APP_MODE') }}"
        if (isDemo == 'DEMO') {
          toastr.error('This Is Demo Version. You Can Not Change Anything');
          return;
        }

        let id = $(this).data("service_id");
        let current_list = $(this);
        $.ajax({
          url: "{{ url('user/add-to-wishlist') }}" + "/" + id,
          type: "get",
          success: function(response) {
            toastr.success(response.message)
            current_list.addClass('active');
          },
          error: function(error) {
            if (error.status == 401) {
              toastr.error("{{ __('admin.Please login to first') }}");
            }

            if (error.status == 403) {
              toastr.error(error.responseJSON.message);
            }
          }

        });

      })

      $("#lang_swithcer").on("change", function(e) {
        $("#lang_swithcer_form").submit();
      })

      $("#lang_swithcer_for_mobile").on("change", function(e) {
        $("#lang_swithcer_form_for_mobile").submit();
      })

      $("#currency_swithcer").on("change", function(e) {
        $("#currency_swithcer_form").submit();
      })


    });
  })(jQuery);

  function sendNewMessagePrevLogin() {
    toastr.error("{{ __('admin.Please login first') }}");
  }
</script>
@stack('frontend_js')


{{-- start live chat --}}

@auth('web')
  <script>
    let default_avatar = "{{ $setting->default_avatar }}";

    let active_provider_id = 0;

    (function($) {
      "use strict";
      $(document).ready(function() {

        $("#chat-form").on("submit", function(e) {

          e.preventDefault();

          var isDemo = "{{ env('APP_MODE') }}"
          if (isDemo == 'DEMO') {
            toastr.error('This Is Demo Version. You Can Not Change Anything');
            return;
          }

          let message = $("#provider_message").val();
          if (message == '') return;
          $.ajax({
            type: "post",
            data: $('#chat-form').serialize(),
            url: "{{ url('user/send-message-to-provider') }}",
            success: function(response) {
              $(".wsus__message_box_text").html(response);
              $("#provider_message").val('');
              scrollToBottomFunc();
            },
            error: function(err) {}
          })
        })

        Echo.private("live_chat.{{ $login_buyer->id }}")
          .listen('LiveChat', (e) => {
            console.log('hi');
            let sender_provider_id = e.message[0].provider_id;

            if (parseInt(sender_provider_id) == parseInt(active_provider_id)) {
              $("#pending-" + sender_provider_id).addClass('d-none');
              $.ajax({
                type: "get",
                url: "{{ url('user/load-chat-box/') }}" + "/" + sender_provider_id,
                success: function(response) {
                  $(".wsus__message_box_text").html(response)
                  scrollToBottomFunc();
                },
                error: function(err) {}
              })
            } else {

              let is_exist = false;
              $('.provider-list').each(function() {
                let provider_Id = $(this).data('provider-id');
                if (parseInt(provider_Id) == parseInt(sender_provider_id)) is_exist = true;
              });
              console.log('befr logic');

              if (is_exist) {
                let current_qty = $("#pending-" + sender_provider_id).html();
                let new_qty = parseInt(current_qty) + parseInt(1);
                $("#pending-" + sender_provider_id).html(new_qty);
                console.log(new_qty);
                $("#pending-" + sender_provider_id).removeClass('d-none');
              }

              console.log('after logic');
            }
          });


        // Echo.channel(`test_event`)
        // .listen('TestEvent', (e) => {
        //     console.log('listening event', e);
        // });

      });

    })(jQuery);




    function loadChatBox(provider_id) {
      $("#message_provider_id").val(provider_id);
      active_provider_id = provider_id;
      $(".wsus__empty_message").addClass('d-none');
      $(".wsus__message_preloader").removeClass('d-none');
      $("#pending-" + provider_id).addClass('d-none');
      $("#pending-" + provider_id).html(0);

      $(".provider-list").removeClass('active');
      $(".single-provider-" + provider_id).addClass('active');

      $.ajax({
        type: "get",
        url: "{{ url('user/load-chat-box/') }}" + "/" + provider_id,
        success: function(response) {
          $(".wsus__message_box_text").html(response)
          $(".wsus__message_preloader").addClass('d-none');
          $(".wsus__message_box_text").removeClass('d-none');
          scrollToBottomFunc();
        },
        error: function(err) {}
      })
    }

    function scrollToBottomFunc() {
      $('.wsus__message_box_text').animate({
        scrollTop: $('.wsus__message_box_text').get(0).scrollHeight
      }, 50);
    }

    function sendNewMessage(name, id, designation, image, service_id = null, service_name = null, service_image = null) {

      let root_url = "{{ route('home') }}";
      let avatar = '';
      if (image) {
        avatar = `<img src="${root_url}/${image}" alt="user" class="img-fluid w-100">`
      } else {
        avatar = `<img src="${root_url}/${default_avatar}" alt="user" class="img-fluid w-100">`
      }

      let new_item = `<li class="provider-list single-provider-${id}" data-provider-id="${id}" onclick="loadChatBox(${id})">
            <div class="img">
                ${avatar}
                <span id="pending-${id}" class="d-none">0</span>
            </div>
            <div class="text">
                <h3>${name}</h3>
                <p>${designation}</p>
            </div>
        </li>`;

      let is_exist = false;
      $('.provider-list').each(function() {
        let provider_Id = $(this).data('provider-id');
        if (parseInt(provider_Id) == parseInt(id)) is_exist = true;
      });

      if (is_exist == false) {
        $("#provider_existing_list").prepend(new_item)
      }

      $(".wsus__message_area").addClass("show_chat");

      let _token = "{{ csrf_token() }}";

      $(".single-provider-" + id).click();

      $("#message_provider_id").val(id);

      if (service_id != null) {
        $.ajax({
          type: "post",
          data: {
            _token,
            provider_id: id,
            service_id: service_id
          },
          url: "{{ url('user/send-message-to-provider') }}",
          success: function(response) {
            $(".wsus__message_box_text").html(response);
            scrollToBottomFunc();
          },
          error: function(err) {}
        })
      }
    }
  </script>
@endauth

{{-- end live chat --}}

@stack('scripts')

</body>

</html>
