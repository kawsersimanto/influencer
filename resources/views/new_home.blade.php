@extends('layout')
@section('title')
  <title>{{ $seo_setting->seo_title }}</title>
  <meta name="keywords" content="{{ $seo_setting->seo_keyword }}">
  <meta name="title" content="{{ $seo_setting->seo_title }}">
  <meta name="description" content="{{ $seo_setting->seo_description }}">
@endsection
@section('frontend-content')
<!-- inflanar Hero -->
<section class="pt-40">
  <div class="container">
    <div class="flex flex-col justify-center">
      <h1 class="text-center md:text-[41px] text-[34px] font-bold">Influencer Marketing Made Easy</h1>
      <div>
        <p class="text-center mt-4 mb-12">Find and hire top Instagram, TikTok, YouTube, and UGC influencers to create
          unique content for your brand</p>
        <form action="{{ route('services', 'search, categories') }}"
          class="shadow-light-shadow sm:rounded-[50px] rounded-[24px] max-w-[1200px] mx-auto gap-2 flex sm:flex-row flex-col items-center p-2 home-search"
          method="GET">
          @csrf
          @method('GET')
          <select name="search" id="search">
            <option>Select a platform</option>
            @foreach ($platforms as $platform)
              <option value="{{ $platform->name }}">{{ $platform->name }}</option>
            @endforeach
          </select>
          <span class="sm:h-[20px] h-[1px] sm:w-[2px] w-full bg-slate-200"></span>
          {{-- {{ dd($categories) }} --}}
          <select multiple name="categories[]" data-placeholder="Category">
            @foreach ($categories as $item)
              <option value="{{ $item->slug }}">{{ $item->slug }}</option>
            @endforeach
          </select>

          <button type="submit"
            class="bg-main flex-shrink-0 h-[48px] rounded-[50px] border-0 sm:w-[48px] w-full flex items-center justify-center">
            <i class="fa-solid fa-magnifying-glass text-xl"></i></button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- End inflanar Hero -->

<!-- Featured -->
<section class="pt-20 pb-10">
    <div class="container">
      <div class="flex justify-between items-center">
        <!-- Section Title -->
        <div class="mb-4 max-w-[300px]">
          <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
            Featured
          </h2>
          <p>Hire top influencers across all platforms</p>
        </div>
        <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
      </div>
      <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
        @foreach ($featured_services as $index => $featured_service)
          <a href="/influencers/{{ $featured_service->influencer->username }}" class="group">
            <div class="rounded-xl overflow-hidden relative">
              <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
              <img src="{{ asset($featured_service->thumbnail_image) }}"
                class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
                alt="">
              <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
                <p class="text-sm text-white font-agrandir me-1">
                  @if ($featured_service->influencer)
                    {{ $featured_service->influencer->name }}
                  @endif
                </p>
                <div class="flex items-center gap-2">
                  @php
                    if ($featured_service->total_review > 0) {
                        $average = $featured_service->average_rating;
                    }
                  @endphp
                  <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
                  <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-between pt-2">
              <p class="text-[12px]">{{ $featured_service->category->name }}</p>
              <p class="text-black text-sm font-medium">{{ currency($featured_service->price) }}</p>
            </div>
            <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $featured_service->title }}</h3>
          </a>
          @if ($loop->iteration >= 4)
          @break
        @endif
      @endforeach
    </div>
  </div>
</section>
<!-- Featured -->

<!-- Instagram -->
<section class="py-10">
  <div class="container">
    <div class="flex justify-between items-center">
      <!-- Section Title -->
      <div class="mb-4 max-w-[300px]">
        <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
          Instagram
        </h2>
        <p>Hire Instagram influencers</p>
      </div>
      <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
      @foreach ($featured_services as $index => $featured_service)
        @if ($featured_service->platform->name == 'Instagram')
          <a href="/influencers/{{ $featured_service->influencer->username }}" class="group">
            <div class="rounded-xl overflow-hidden relative">
              <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
              <img src="{{ asset($featured_service->thumbnail_image) }}"
                class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
                alt="">
              <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
                <p class="text-sm text-white font-agrandir me-1">
                  @if ($featured_service->influencer)
                    {{ $featured_service->influencer->name }}
                  @endif
                </p>
                <div class="flex items-center gap-2">
                  @php
                    if ($featured_service->total_review > 0) {
                        $average = $featured_service->average_rating;
                    }
                  @endphp
                  <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
                  <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-between pt-2">
              <p class="text-[12px]">{{ $featured_service->category->name }}</p>
              <p class="text-black text-sm font-medium">{{ currency($featured_service->price) }}</p>
            </div>
            <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $featured_service->title }}</h3>
          </a>
          @if ($loop->iteration >= 4)
          @break
        @endif
        <!-- Exit the loop after 4 items -->
      @endif
    @endforeach
  </div>
</div>
</section>
<!-- Instagram -->

<!-- TikTok -->
<section class="py-10">
<div class="container">
  <div class="flex justify-between items-center">
    <!-- Section Title -->
    <div class="mb-4 max-w-[300px]">
      <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
        TikTok
      </h2>
      <p>Hire TikTok influencers</p>
    </div>
    <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
  </div>
  <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
    @foreach ($featured_services as $index => $featured_service)
      @if ($featured_service->platform->name == 'TikTok')
        <a href="/influencers/{{ $featured_service->influencer->username }}" class="group">
          <div class="rounded-xl overflow-hidden relative">
            <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
            <img src="{{ asset($featured_service->thumbnail_image) }}"
              class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
              alt="">
            <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
              <p class="text-sm text-white font-agrandir me-1">
                @if ($featured_service->influencer)
                  {{ $featured_service->influencer->name }}
                @endif
              </p>
              <div class="flex items-center gap-2">
                @php
                  if ($featured_service->total_review > 0) {
                      $average = $featured_service->average_rating;
                  }
                @endphp
                <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
                <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
              </div>
            </div>
          </div>
          <div class="flex items-center justify-between pt-2">
            <p class="text-[12px]">{{ $featured_service->category->name }}</p>
            <p class="text-black text-sm font-medium">{{ currency($featured_service->price) }}</p>
          </div>
          <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $featured_service->title }}</h3>
        </a>
        @if ($loop->iteration >= 4)
        @break
      @endif
    @endif
  @endforeach
</div>
</div>
</section>
<!-- TikTok -->

<!-- Categories Studies -->
<section id="categories" class="blog-area inflanar-bg-cover py-10">
  <div class="blog-bg-pattern">
  <div class="container">
  
  <div class="flex justify-between items-center mb-4">
    <!-- Section Title -->
    <div class="max-w-[300px]">
      <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
        Categories
      </h2>
    </div>
  </div>
  
  
  <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
    @foreach ($categories as $category)
    {{-- {{ dd($category) }} --}}
        <div class="group">
          <div class="rounded-xl overflow-hidden relative">
            <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
            <img src="{{ asset($category->icon) }}"
              class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
              alt="{{ $category->slug }}">
            <div class="absolute md:left-[30px] left-[10px] md:bottom-[30px] bottom-[10px] md:right-[30px] right-[10px] flex items-center gap-1 z-[3]">
              <p class="text-[20px] capitalize text-white font-agrandir">
                {{ $category->slug }}
              </p>
            </div>
          </div>
        </div>
        @if ($loop->iteration >= 4)
          @break
        @endif
  @endforeach
  </div>
  
  </div>
  </div>
</section>
<!-- Categories Studies -->

<!-- Any -->
<section class="pt-10 pb-20">
<div class="container">
<div class="flex justify-between items-center">
  <!-- Section Title -->
  <div class="mb-4 max-w-[300px]">
    <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
      Any
    </h2>
    <p>Hire Any influencers</p>
  </div>
  <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
</div>
<div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
  @foreach ($featured_services as $index => $featured_service)
    @if ($featured_service->platform->name == 'Any')
      <a href="/influencers/{{ $featured_service->influencer->username }}" class="group">
        <div class="rounded-xl overflow-hidden relative">
          <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
          <img src="{{ asset($featured_service->thumbnail_image) }}"
            class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
            alt="">
          <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
            <p class="text-sm text-white font-agrandir me-1">
              @if ($featured_service->influencer)
                {{ $featured_service->influencer->name }}
              @endif
            </p>
            <div class="flex items-center gap-2">
              @php
                if ($featured_service->total_review > 0) {
                    $average = $featured_service->average_rating;
                }
              @endphp
              <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
              <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
            </div>
          </div>
        </div>
        <div class="flex items-center justify-between pt-2">
          <p class="text-[12px]">{{ $featured_service->category->name }}</p>
          <p class="text-black text-sm font-medium">{{ currency($featured_service->price) }}</p>
        </div>
        <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $featured_service->title }}</h3>
      </a>
      @if ($loop->iteration >= 4)
      @break
    @endif
  @endif
@endforeach
</div>
</div>
</section>
<!-- Any -->

{{-- search and features --}}
<section class="pb-20">
  <div class="container">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-[80px]">
      <div class="flex flex-col items-start">
        <span class="px-4 py-2 rounded-[12px] shadow-light-shadow bg-peach-gold-gradient font-agrandir">Search</span>
        <h2 class="font-semibold text-3xl md:mt-5 mt-3 md:mb-16 mb-10">Find and Hire Influencers in Seconds on the Marketplace</h2>
        <div class="flex flex-col md:gap-12 gap-8">
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Search Influencer</h3>
            <p>Search thousands of vetted Instagram, TikTok, and YouTube influencers.</p>
          </div>
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Purchase & Chat Securely</h3>
            <p>Safely purchase and communicate through Collabstr. We hold your payment until the work is completed.</p>
          </div>
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Receive Quality Content</h3>
            <p>Receive your high-quality content from influencers directly through the platform.</p>
          </div>
        </div>
      </div>
      <div>
        <img src="{{ asset("frontend/new-img/marketplace.png") }}" alt="Find and Hire Influencers in Seconds on the Marketplace">
      </div>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 lg:gap-5 gap-3 lg:pt-32 pt-20">
      <div class="shadow-light-shadow rounded-lg flex flex-col gap-2 p-4 border-l-2 border-l-main">
        <i class="fa-solid fa-dollar-sign text-main text-3xl"></i>
        <h3 class="font-semibold text-xl">No Upfront Cost</h3>
        <p class="text-sm">Search influencers for free. No subscriptions, contracts or hidden fees.</p>
      </div>
      <div class="shadow-light-shadow rounded-lg flex flex-col gap-2 p-4 border-l-2 border-l-main">
        <i class="fa-solid fa-dollar-sign text-main text-3xl"></i>
        <h3 class="font-semibold text-xl">Vetted Influencers</h3>
        <p class="text-sm">Instantly chat with influencers and stay in touch throughout the whole transaction.</p>
      </div>
      <div class="shadow-light-shadow rounded-lg flex flex-col gap-2 p-4 border-l-2 border-l-main">
        <i class="fa-solid fa-dollar-sign text-main text-3xl"></i>
        <h3 class="font-semibold text-xl">Instant Chat</h3>
        <p class="text-sm">Instantly chat with influencers and stay in touch throughout the whole transaction.</p>
      </div>
      <div class="shadow-light-shadow rounded-lg flex flex-col gap-2 p-4 border-l-2 border-l-main">
        <i class="fa-solid fa-dollar-sign text-main text-3xl"></i>
        <h3 class="font-semibold text-xl">Secure Purchases</h3>
        <p class="text-sm">Your money is held safely until you approve the influencer’s work.</p>
      </div>
    </div>
  </div>
</section>
{{-- search and features --}}

{{-- campaign and features --}}
<section class="pt-20 pb-20">
  <div class="container">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-[80px] items-center">
      <div>
        <img src="{{ asset("frontend/new-img/campaign.png") }}" alt="Find and Hire Influencers in Seconds on the Marketplace">
      </div>
      <div class="flex flex-col items-start">
        <span class="px-4 py-2 rounded-[12px] shadow-light-shadow bg-peach-gold-gradient font-agrandir">Campaigns</span>
        <h2 class="font-semibold text-3xl md:mt-8 mt-3 md:mb-16 mb-10">Post Campaigns and Have 170,000+ Influencers Come to You</h2>
        <div class="flex flex-col md:gap-12 gap-8">
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Set Targeting</h3>
            <p>Specify demographics including niche, location and following size of the influencers you want to target.</p>
          </div>
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Post Campaign</h3>
            <p>Centralize your images, requirements, and more in a campaign brief sent to 170,000 influencers.</p>
          </div>
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Influencers Apply</h3>
            <p>Targeted influencers submit their pricing, and you choose who to collaborate with.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
{{-- campaign and features --}}

{{-- Track --}}
<section class="pt-20 pb-20">
  <div class="container">
    <div class="grid md:grid-cols-2 grid-cols-1 gap-[80px]">
      <div class="flex flex-col items-start">
        <span class="px-4 py-2 rounded-[12px] shadow-light-shadow bg-peach-gold-gradient font-agrandir">Track</span>
        <h2 class="font-semibold text-3xl md:mt-5 mt-3 md:mb-16 mb-10">Track Post Analytics and Performance in Real Time</h2>
        <div class="flex flex-col md:gap-12 gap-8">
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">One-Click Tracking</h3>
            <p>Track Instagram, TikTok, and YouTube content in real time from a single dashboard. Say goodbye to manual tracking and messy spreadsheets.</p>
          </div>
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Advanced Analytics & Reporting</h3>
            <p>Analyze content performance over time, including impressions, engagement and more. Organize performance by campaign and effortlessly build reports.</p>
          </div>
          <div>
            <h3 class="text-[20px] text-black font-semibold mb-2">Fully Automated</h3>
            <p>Metrics are updated every 24 hours, ensuring performance data is always up-to-date.</p>
          </div>
        </div>
      </div>
      <div>
        <img src="{{ asset("frontend/new-img/tracking.png") }}" alt="Find and Hire Influencers in Seconds on the Marketplace">
      </div>
    </div>
  </div>
</section>
{{-- Track --}}

<!-- About section -->
<section
class="video-cta inflanar-section-shape3 inflanar-ohidden inflanar-bg-cover pd-top-90 pd-btm-120 inflanar-section-shape2">
<div class="container inflanar-container-medium">
<div class="row align-items-center">
<div class="col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="200">
  <div class="video-cta__content">
    <h3 class="video-cta__title mg-btm-20">{{ $home_page->video_title }}</h3>
    <p class="video-cta__text">{{ $home_page->video_description }}</p>

    <a href="{{ route('about-us') }}"
      class="inflanar-btn mg-top-40"><span>{{ __('admin.Discover More') }}</span></a>
  </div>
</div>
<div class="col-xl-5 offset-xl-1 col-lg-6 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
  <div class="video-cta__card">
    <img src="{{ asset($home_page->video_image) }}">
    <div class="video-cta__button">
      <a href="#" class="js-video-btn" data-video-id="{{ $home_page->video_id }}"><i
          class="fas fa-play"></i></a>
    </div>
  </div>
</div>
</div>
</div>
</section>
<!-- About section -->

<!-- Viideo CTA -->
<section class="pd-top-90 pd-btm-120 ">
<div class="container inflanar-container-medium">
<div class="row ">
<div class="col-12">
  <div class="funfacts inflanar-row-gap">
    <!-- FunFact Box -->
    <div class="funfacts__box inflanar-section-shape5 inflanar-bg-cover" data-aos="fade-up"
      data-aos-delay="200">
      <div class="funfacts__column">
        <!-- Fun Fact Sinlge -->
        <div class="funfacts__card mg-top-30">
          <div class="funfacts__icon">
            <img src="{{ asset($home_page->facebook_image) }}">
          </div>
          <div class="funfacts__number">
            <h4 class="funfacts__title"><b>{{ $home_page->facebook_follower }}
              </b><span>{{ __('admin.Followers') }}</span></h4>
          </div>
        </div>
        <!-- End Fun Fact Sinlge -->
        <!-- Fun Fact Sinlge -->
        <div class="funfacts__card mg-top-30">
          <div class="funfacts__icon">
            <img src="{{ asset($home_page->twitter_image) }}">
          </div>
          <div class="funfacts__number">
            <h4 class="funfacts__title"><b>{{ $home_page->twitter_follower }}
              </b><span>{{ __('admin.Followers') }}</span></h4>
          </div>
        </div>
        <!-- End Fun Fact Sinlge -->
      </div>
      <div class="funfacts__column funfacts__column__last">
        <!-- Fun Fact Sinlge -->
        <div class="funfacts__card mg-top-30">
          <div class="funfacts__icon">
            <img src="{{ asset($home_page->tiktok_image) }}">
          </div>
          <div class="funfacts__number">
            <h4 class="funfacts__title"><b>{{ $home_page->tiktok_follower }}
              </b><span>{{ __('admin.Followers') }}</span></h4>
          </div>
        </div>
        <!-- End Fun Fact Sinlge -->
        <!-- Fun Fact Sinlge -->
        <div class="funfacts__card mg-top-30">
          <div class="funfacts__icon">
            <img src="{{ asset($home_page->instagram_image) }}">
          </div>
          <div class="funfacts__number">
            <h4 class="funfacts__title"><b>{{ $home_page->instagram_follower }}
              </b><span>{{ __('admin.Followers') }}</span></h4>
          </div>
        </div>
        <!-- End Fun Fact Sinlge -->
      </div>
    </div>
    <!-- End FunFact Box -->

    <!-- Brands -->
    <div class="brands" data-aos="fade-up" data-aos-delay="400">
      <h2 class="inflanar-section__title mg-btm-20">{!! strip_tags(clean($home_page->partner_title), '<span>') !!}</span></h2>
      <div class="row">
        @foreach ($partners as $partner)
          <div class="col-lg-4 col-md-4 col-6 mg-top-30">
            <div class="brands__single">
              <a href="{{ $partner->link ? $partner->link : 'javascript:;' }}"><img
                  src="{{ asset($partner->logo) }}"></a>
            </div>
          </div>
        @endforeach

      </div>
    </div>
    <!-- End Brands -->
  </div>
</div>
</div>
</div>
</section>
<!-- End Viideo CTA -->

<!-- Trusted By 110, 000+ Brands -->
<section class="pt-20 pb-10">
  <div class="container">
  <div class="flex justify-between items-center">
    <!-- Section Title -->
    <div class="mb-4">
      <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
        Trusted By 110, 000+ Brands
      </h2>
      <p>View collaborations from brands like Wealthsimple, Hopper, Deezer, and more.</p>
    </div>
    <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
  </div>
  <div class="grid lg:grid-cols-5 md:grid-cols-3 grid-cols-2 gap-4">
    <div class="relative video-element" class="trust-video">
      <video class="h-[330px] rounded-lg overflow-hidden w-full object-cover new-video">
        <source src="https://d5ik1gor6xydq.cloudfront.net/websiteImages/content/1.mp4#t=0.1">
      </video>
      <i class="fa-solid fa-play play-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] cursor-pointer"></i>
      <i class="fa-solid fa-pause pause-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] hidden cursor-pointer"></i>
    </div>
    <div class="relative video-element" class="trust-video">
      <video class="h-[330px] rounded-lg overflow-hidden w-full object-cover new-video">
        <source src="https://d5ik1gor6xydq.cloudfront.net/websiteImages/content/3.mp4#t=0.1">
      </video>
      <i class="fa-solid fa-play play-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] cursor-pointer"></i>
      <i class="fa-solid fa-pause pause-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] hidden cursor-pointer"></i>
    </div>
    <div class="relative video-element" class="trust-video">
      <video class="h-[330px] rounded-lg overflow-hidden w-full object-cover new-video">
        <source src="https://d5ik1gor6xydq.cloudfront.net/websiteImages/content/5.mp4#t=0.1">
      </video>
      <i class="fa-solid fa-play play-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] cursor-pointer"></i>
      <i class="fa-solid fa-pause pause-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] hidden cursor-pointer"></i>
    </div>
    <div class="relative video-element" class="trust-video">
      <video class="h-[330px] rounded-lg overflow-hidden w-full object-cover new-video">
        <source src="https://d5ik1gor6xydq.cloudfront.net/websiteImages/content/1.mp4#t=0.1">
      </video>
      <i class="fa-solid fa-play play-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] cursor-pointer"></i>
      <i class="fa-solid fa-pause pause-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] hidden cursor-pointer"></i>
    </div>
    <div class="relative video-element" class="trust-video">
      <video class="h-[330px] rounded-lg overflow-hidden w-full object-cover video new-video">
        <source src="https://d5ik1gor6xydq.cloudfront.net/websiteImages/content/5.mp4#t=0.1">
      </video>
      <i class="fa-solid fa-play play-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] cursor-pointer"></i>
      <i class="fa-solid fa-pause pause-btn text-white absolute left-[20px] right-[20px] bottom-[20px] z-[1] hidden cursor-pointer"></i>
    </div>
  </div>
  </div>
</section>
<!-- Trusted By 110, 000+ Brands -->

<!-- Case Studies -->
<section id="blog" class="blog-area inflanar-bg-cover py-10">
<div class="blog-bg-pattern">
<div class="container">

<div class="flex justify-between items-center mb-4">
  <!-- Section Title -->
  <div class="max-w-[300px]">
    <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
      Case Studies
    </h2>
  </div>
</div>


<div class="grid lg:grid-cols-3 md:grid-cols-3 grid-cols-2 gap-4">
  @foreach ($blogs as $index => $blog)
      <a href="{{ route('blog', $blog->slug) }}" class="group">
        <div class="rounded-xl overflow-hidden relative">
          <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
          <img src="{{ asset($blog->image) }}"
            class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
            alt="">
          <div class="absolute md:left-[30px] left-[10px] md:bottom-[30px] bottom-[10px] md:right-[30px] right-[10px] flex items-center gap-1 z-[3]">
            <p class="text-[20px] text-white font-agrandir">
              {{ $blog->title }}
            </p>
          </div>
        </div>
      </a>
@endforeach
</div>

</div>
</div>
</section>
<!-- Case Studies -->

<!-- Testimonials -->
<section class="py-40">
  <div class="container">
    <!-- Section Title -->
    <div class="flex justify-between items-center mb-12">
      <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
        110,000+ Brands Work With Influencers on Brandfam
      </h2>
    </div>
    <div class="grid md:grid-cols-3 grid-cols-1 md:gap-16 gap-12">
      <div class="flex flex-col gap-4">
        <div>
          <i class="fa-solid fa-quote-left text-3xl mb-2 text-main"></i>
          <h3 class="italic font-semibold text-black">5 stars from a creator and a brand</h3>
        </div>
        <p>I've used Brandfam from both the Creator side and the Brand side! It is extremely user-friendly and has lead to some great relationships with creators/brands I wouldn't have been connected to otherwise. Love the platform!</p>
        <p class="italic font-semibold text-black">Layla - Influencer & Founder</p>
      </div>
      <div class="flex flex-col gap-4">
        <div>
          <i class="fa-solid fa-quote-left text-3xl mb-2 text-main"></i>
          <h3 class="italic font-semibold text-black">Best platform to connect with influencers</h3>
        </div>
        <p>Best platform to connect with influencers and content creators. I've signed up to many platforms, collabstr is the easiest to use and gives the best results for my brand.</p>
        <p class="italic font-semibold text-black">Myriam - Founder of BBeyond</p>
      </div>
      <div class="flex flex-col gap-4">
        <div>
          <i class="fa-solid fa-quote-left text-3xl mb-2 text-main"></i>
          <h3 class="italic font-semibold text-black">Great way to generate content</h3>
        </div>
        <p>Been using Collabstr to generate content for our seasonal clothing lines. Super easy for us to search for relevant influencers and pay them. We save at least 10-20 hours a month on this.</p>
        <p class="italic font-semibold text-black">Courtney - Marketer</p>
      </div>
    </div>
  </div>
</section>
<!--Testimonials -->

<!-- Youtube -->
<section class="py-10">
  <div class="container">
    <div class="flex justify-between items-center">
      <!-- Section Title -->
      <div class="mb-4 max-w-[300px]">
        <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
          Youtube
        </h2>
        <p>Hire Youtube influencers</p>
      </div>
      <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
      @foreach ($featured_services as $index => $featured_service)
        @if ($featured_service->platform->name == 'Youtube')
          <a href="/influencers/{{ $featured_service->influencer->username }}" class="group">
            <div class="rounded-xl overflow-hidden relative">
              <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
              <img src="{{ asset($featured_service->thumbnail_image) }}"
                class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
                alt="">
              <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
                <p class="text-sm text-white font-agrandir me-1">
                  @if ($featured_service->influencer)
                    {{ $featured_service->influencer->name }}
                  @endif
                </p>
                <div class="flex items-center gap-2">
                  @php
                    if ($featured_service->total_review > 0) {
                        $average = $featured_service->average_rating;
                    }
                  @endphp
                  <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
                  <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-between pt-2">
              <p class="text-[12px]">{{ $featured_service->category->name }}</p>
              <p class="text-black text-sm font-medium">{{ currency($featured_service->price) }}</p>
            </div>
            <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $featured_service->title }}</h3>
          </a>
          @if ($loop->iteration >= 4)
          @break
        @endif
      @endif
    @endforeach
  </div>
  </div>
</section>
<!-- Youtube -->

<!-- User Generate Content -->
<section class="pt-10 pb-20">
  <div class="container">
    <div class="flex justify-between items-center">
      <!-- Section Title -->
      <div class="mb-4 max-w-[300px]">
        <h2 class="text-2xl font-semibold font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
          User Generated Content
        </h2>
        <p>Hire User Generated Content influencers</p>
      </div>
      <a href="/influencers" class="underline font-agrandir flex-shrink-0">View All</a>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
      @foreach ($featured_services as $index => $featured_service)
        @if ($featured_service->platform->name == 'User Generated Content')
          <a href="/influencers/{{ $featured_service->influencer->username }}" class="group">
            <div class="rounded-xl overflow-hidden relative">
              <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
              <img src="{{ asset($featured_service->thumbnail_image) }}"
                class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
                alt="">
              <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
                <p class="text-sm text-white font-agrandir me-1">
                  @if ($featured_service->influencer)
                    {{ $featured_service->influencer->name }}
                  @endif
                </p>
                <div class="flex items-center gap-2">
                  @php
                    if ($featured_service->total_review > 0) {
                        $average = $featured_service->average_rating;
                    }
                  @endphp
                  <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
                  <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-between pt-2">
              <p class="text-[12px]">{{ $featured_service->category->name }}</p>
              <p class="text-black text-sm font-medium">{{ currency($featured_service->price) }}</p>
            </div>
            <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $featured_service->title }}</h3>
          </a>
          @if ($loop->iteration >= 4)
          @break
        @endif
      @endif
    @endforeach
  </div>
  </div>
</section>
<!-- User Generate Content -->

<!-- Faq Area -->
<section class="pt-10 pb-28">
  <div class="container">
    <div class="">
      <div class="">
        <div class="inflanar-accordion accordion accordion-flush" id="inflanar-accordion">
          @foreach ($faqs as $index => $faq)
            <!-- End Single Accordion -->
            <div class="accordion-item inflanar-accordion__single {{ $index == 0 ? 'active' : '' }} mg-top-20">
              <h2 class="accordion-header" id="inflanart-{{ $index }}">
                <button class="accordion-button collapsed inflanar-accordion__heading" type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#ac-collapse{{ $index }}">{{ $faq->question }}</button>
              </h2>
              <div id="ac-collapse{{ $index }}"
                class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}"
                data-bs-parent="#inflanar-accordion">
                <div class="accordion-body inflanar-accordion__body">{!! clean($faq->answer) !!}</div>
              </div>
            </div>
            <!-- End Single Accordion -->
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- End Faq Area -->

@endsection

@push('scripts')
  <script>

  document.addEventListener("DOMContentLoaded", () => {
      const videos = document.querySelectorAll(".new-video");
      videos.forEach((video) => {
        const videoElement = video.closest(".video-element");
        console.log(videoElement)
        const playBtn = videoElement.querySelector(".play-btn");
        const pauseBtn = videoElement.querySelector(".pause-btn");
        console.log({playBtn, pauseBtn, videoElement})
        playBtn.addEventListener("click", () => {
          video.play();
          playBtn.classList.add("hidden");
          pauseBtn.classList.remove("hidden");
        });
        pauseBtn.addEventListener("click", () => {
          video.pause();
          playBtn.classList.remove("hidden");
          pauseBtn.classList.add("hidden");
        });
        video.addEventListener("ended", () => {
          playBtn.classList.remove("hidden");
          pauseBtn.classList.add("hidden");
          video.currentTime = 0;
        });
      })
  });
  </script>

@endpush