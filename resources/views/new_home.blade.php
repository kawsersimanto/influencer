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
              <option value="any">Any</option>
              <option value="instagram">Instagram</option>
              <option value="tiktok">TikTok</option>
              <option value="User Generate Content">User Generate Content</option>
              <option value="youtube">YouTube</option>
              <option value="twitter">Twitter</option>
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

  <!-- Top Influencers -->
  <section class="py-20">
    <div class="container">
      <div class="flex justify-between items-center">
        <!-- Section Title -->
        <div class="mb-4 max-w-[300px]">
          <h2 class="text-xl font-medium font-agrandir text-black" data-aos="fade-in" data-aos-delay="300">
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
        @endforeach
      </div>
    </div>
  </section>
  <!-- End Influencers -->

  <!-- Services -->
  <section class="inflanar-section-shape inflanar-bg-cover pd-top-120 pd-btm-120">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Section TItle -->
          <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
            <span class="inflanar-section__badge inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
              <span>{{ $home_page->service_title }}</span> <img
                src="{{ asset('frontend/img/in-section-vector2.svg') }}">
            </span>
            <h2 class="inflanar-section__title" data-aos="fade-in" data-aos-delay="400">
              {{ $home_page->service_header }}</h2>
          </div>
        </div>
      </div>
      <div class="row">

      </div>
      <div class="row mg-top-40" data-aos="fade-up" data-aos-delay="600">
        <div class="col-12 d-flex justify-content-center">
          <a href="{{ route('services') }}"
            class="inflanar-btn inflanar-btn__big"><span>{{ __('admin.View All') }}</span></a>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services -->

  <!-- Services -->
  <section class="pd-top-120 pd-btm-120">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Section TItle -->
          <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
            <span class="inflanar-section__badge  inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
              <span>{{ $home_page->working_title }}</span> <img
                src="{{ asset('frontend/img/in-section-vector2.svg') }}">
            </span>
            <h2 class="inflanar-section__title" data-aos="fade-in" data-aos-delay="400">
              {{ $home_page->working_header }}</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="200">
          <!-- Single Card-->
          <div class="inflanar-hcard inflanar-hcard--one">
            <div class="inflanar-hcard__img">
              <img src="{{ asset($working_proccess->home1_image1) }}" alt="#">
            </div>
            <div class="inflanar-hcard__content">
              <div class="inflanar-hcard__line"><img src="{{ asset('frontend/img/in-line-shape1.svg') }}"></div>
              <h4 class="inflanar-hcard__label">
                <span>{{ __('admin.Step') }}</span>
                <b>1</b>
              </h4>
              <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title1 }}</h4>
              <p class="inflanar-hcard__text">{{ $working_proccess->home1_description1 }}</p>
            </div>
          </div>
          <!-- End Single Card-->
        </div>
        <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="400">
          <!-- Single Card-->
          <div class="inflanar-hcard inflanar-hcard--two">
            <div class="inflanar-hcard__content inflanar-hcard__content__two">
              <h4 class="inflanar-hcard__label">
                <span>{{ __('admin.Step') }}</span>
                <b>2</b>
              </h4>
              <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title2 }}</h4>
              <p class="inflanar-hcard__text">{{ $working_proccess->home1_description2 }}</p>
              <div class="inflanar-hcard__line"><img src="{{ asset('frontend/img/in-line-shape2.svg') }}"></div>
            </div>
            <div class="inflanar-hcard__img">
              <img src="{{ asset($working_proccess->home1_image2) }}" alt="#">
            </div>
          </div>
          <!-- End Single Card-->
        </div>
        <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="600">
          <!-- Single Card-->
          <div class="inflanar-hcard inflanar-hcard--one">
            <div class="inflanar-hcard__img">
              <img src="{{ asset($working_proccess->home1_image3) }}" alt="#">
            </div>
            <div class="inflanar-hcard__content">
              <div class="inflanar-hcard__line inflanar-hcard__line--v2"><img
                  src="{{ asset('frontend/img/in-line-shape3.svg') }}"></div>
              <h4 class="inflanar-hcard__label">
                <span>{{ __('admin.Step') }}</span>
                <b>3</b>
              </h4>
              <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title3 }}</h4>
              <p class="inflanar-hcard__text">{{ $working_proccess->home1_description3 }}</p>
            </div>
          </div>
          <!-- End Single Card-->
        </div>
        <div class="col-lg-3 col-md-6 col-12 mg-top-30" data-aos="fade-up" data-aos-delay="800">
          <!-- Single Card-->
          <div class="inflanar-hcard inflanar-hcard--two">
            <div class="inflanar-hcard__content inflanar-hcard__content__two">
              <h4 class="inflanar-hcard__label">
                <span>{{ __('admin.Step') }}</span>
                <b>4</b>
              </h4>
              <h4 class="inflanar-hcard__title">{{ $working_proccess->home1_title4 }}</h4>
              <p class="inflanar-hcard__text">{{ $working_proccess->home1_description4 }}</p>
              <div class="inflanar-hcard__line inflanar-hcard__line--v3"><img
                  src="{{ asset('frontend/img/in-line-shape2.svg') }}"></div>
            </div>
            <div class="inflanar-hcard__img">
              <img src="{{ asset($working_proccess->home1_image4) }}" alt="#">
            </div>
          </div>
          <!-- End Single Card-->
        </div>
      </div>
    </div>
  </section>
  <!-- End Services -->

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

  <!-- Faq Area -->
  <section class="inflanar-bg-cover pd-top-90 pd-btm-120 inflanar-section-shape2  inflanar-ohidden">
    <div class="container inflanar-container-medium">
      <div class="row inflanar-container-medium__row align-items-center">
        <div class="col-lg-5 col-12 mg-top-30">
          <!-- Section TItle -->
          <div class="inflanar-section__head mg-btm-50">
            <span class="inflanar-section__badge inflanar-primary-color m-0" data-aos="fade-in" data-aos-delay="300">
              <span>{{ $home_page->faq_title }}</span> <img src="{{ asset('frontend/img/in-section-vector2.svg') }}">
            </span>
            <h2 class="inflanar-section__title mg-btm-20" data-aos="fade-in" data-aos-delay="400">
              {{ $home_page->faq_header }}</h2>
            <p>{{ $home_page->faq_description }}</p>
          </div>
          <!-- Support Img -->
          <div class="inflanar-support-img" data-aos="fade-up" data-aos-delay="200">
            <img src="{{ asset($home_page->faq_image) }}" alt="#">
          </div>
          <!-- End Support Img -->
        </div>
        <div class="col-lg-7 col-12 mg-top-30">
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

  <!-- Blog Area -->
  <section id="blog" class="blog-area inflanar-bg-cover section-padding">
    <div class="blog-bg-pattern">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- Section TItle -->
            <div class="inflanar-section__head inflanar-section__center text-center mg-btm-20">
              <span class="inflanar-section__badge  inflanar-primary-color m-0" data-aos="fade-in"
                data-aos-delay="300">
                <span>{{ $home_page->blog_title }}</span> <img
                  src="{{ asset('frontend/img/in-section-vector2.svg') }}">
              </span>
              <h2 class="inflanar-section__title" data-aos="fade-in" data-aos-delay="400">
                {{ $home_page->blog_header }}</h2>
            </div>
          </div>
        </div>
        <div class="row">

          @foreach ($blogs as $index => $blog)
            <div class="col-xl-3 col-lg-4 col-md-6 col-12">
              <!-- Single Blog -->
              <div class="inflanar-blog">
                <div class="inflanar-blog__head">
                  <a href="{{ route('blog', $blog->slug) }}"><img src="{{ asset($blog->image) }}" alt="#"></a>
                </div>
                <!-- Blog Content -->
                <div class="inflanar-blog__content">
                  <ul class="inflanar-blog__meta list-none">
                    <li><img src="{{ asset('frontend/img/in-author-icon.svg') }}">{{ __('admin.By') }}
                      <span>{{ $blog->author ? $blog->author->name : '' }}</span>
                    </li>
                    <li><img src="{{ asset('frontend/img/in-calendar-icon.svg') }}">
                      {{ $blog->created_at->format('d M Y') }}</li>
                  </ul>
                  <h3 class="inflanar-blog__title"><a href="{{ route('blog', $blog->slug) }}">{{ $blog->title }}</a>
                  </h3>
                </div>
              </div>
              <!-- End Single Blog -->
            </div>
          @endforeach

        </div>
      </div>
    </div>
  </section>
  <!-- End Blog Area -->
@endsection
