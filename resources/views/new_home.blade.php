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

<!-- Case Studies -->
<section id="blog" class="blog-area inflanar-bg-cover py-10">
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
  <!-- Case Studies -->

<!-- Any -->
<section class="py-10">
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

<!-- Viideo CTA -->
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
<!-- End Viideo CTA -->

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