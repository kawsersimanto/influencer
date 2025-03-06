@extends('layout')

@section('title')
  <title>Find Instagram, Tik Tok & Youtube Influencers</title>
  <meta name="keywords" content="Find Instagram, Tik Tok & Youtube Influencers">
@endsection

@section('frontend-content')
  <!-- inflanar Hero -->
  <section class="pt-40">
    <div class="container">
      <div class="flex flex-col justify-center">
        <h1 class="text-center md:text-[41px] text-[34px] font-bold">Simplifying Influencer Marketing</h1>
        <div>
          <p class="text-center mt-4 mb-12">Find and hire top Instagram, TikTok, YouTube, and UGC influencers to create
            unique content for your brand</p>
          {{-- <form action="{{ route('services', 'search, categories') }}"
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
            <select multiple name="categories[]" data-placeholder="Category">
              @foreach ($categories as $item)
                <option value="{{ $item->slug }}">{{ $item->slug }}</option>
              @endforeach
            </select>

            <button type="submit"
              class="bg-main flex-shrink-0 h-[48px] rounded-[50px] border-0 sm:w-[48px] w-full flex items-center justify-center">
              <i class="fa-solid fa-magnifying-glass text-xl"></i></button>
          </form> --}}

          <form id="filterForm" action="{{ route('search.filter', ['platform', 'categories']) }}" method="GET" class="shadow-light-shadow sm:rounded-[50px] rounded-[24px] max-w-[1200px] mx-auto gap-2 flex sm:flex-row flex-col items-center p-2 home-search">
            @csrf
            <select name="platform" id="platform">
              <option value="">Select a platform</option>
              @foreach ($platforms as $platform)
                <option value="{{ $platform->name }}">{{ $platform->name }}</option>
              @endforeach
            </select>
          
            <select multiple name="categories[]" id="categories" data-placeholder="Category">
              @foreach ($categories as $item)
                <option value="{{ $item->slug }}">{{ $item->slug }}</option>
              @endforeach
            </select>
          
            <button type="submit" class="bg-main flex-shrink-0 h-[48px] rounded-[50px] border-0 sm:w-[48px] w-full flex items-center justify-center">
              <i class="fa-solid fa-magnifying-glass text-xl"></i>
            </button>
          </form>
          
        </div>
      </div>
    </div>
  </section>
  <!-- End inflanar Hero -->

  <!-- Featured -->
  <section class="pt-20 pb-40">
    <div class="container">
      <div class="grid lg:grid-cols-4 md:grid-cols-3 grid-cols-2 gap-4">
        @foreach ($services as $index => $service)
          <a href="/influencers/{{ $service->influencer->username }}" class="group">
            <div class="rounded-xl overflow-hidden relative">
              <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
              <img src="{{ asset($service->thumbnail_image) }}"
                class="sm:h-[280px] h-[180px] w-full object-cover transition-transform duration-500 group-hover:scale-[1.1]"
                alt="">
              <div class="absolute left-[10px] bottom-[10px] flex items-center gap-1 z-[3]">
                <p class="text-sm text-white font-agrandir me-1">
                  @if ($service->influencer)
                    {{ $service->influencer->name }}
                  @endif
                </p>
                <div class="flex items-center gap-2">
                  @php
                    if ($service->total_review > 0) {
                        $average = $service->average_rating;
                    }
                  @endphp
                  <i class="fa-solid fa-star text-yellow-400 text-[12px]"></i>
                  <span class="text-white text-sm font-agrandir font-normal">{{ number_format($average, 1) }}</span>
                </div>
              </div>
            </div>
            <div class="flex items-center justify-between pt-2">
              <p class="text-[12px]">{{ $service->category->name }}</p>
              <p class="text-black text-sm font-medium">{{ currency($service->price) }}</p>
            </div>
            <h3 class="font-agrandir line-clamp-1 mt-2 duration-300">{{ $service->title }}</h3>
          </a>
        @endforeach
      </div>
    </div>
  </section>
  <!-- Featured -->
@endsection

@push('scripts')

{{-- <script>

document.getElementById('filterForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const platform = document.getElementById('platform').value;
    const categories = Array.from(document.getElementById('categories').selectedOptions)
        .map(option => option.value)
        .join(',');

    fetchResults(platform, categories);
});

function fetchResults(platform, categories) {
    const apiUrl = `http://127.0.0.1:8000/search/filter?platform=${platform}&categories=${categories}`;
    console.log(apiUrl);

    fetch(apiUrl)
        .then(response => response.json())
        .then(data => updateGrid(data.services.data))
        .catch(error => console.error('Error:', error));
}

function updateGrid(services) {
    const grid = document.querySelector('.grid');
    grid.innerHTML = '';

    services.forEach(service => {
        grid.innerHTML += `
            <a href="/influencers/${service.influencer.username}" class="group">
                <div class="rounded-xl overflow-hidden relative">
                    <div class="absolute top-0 left-0 right-0 bottom-0 bg-black/40 z-[2]"></div>
                    <img src="/storage/${service.thumbnail_image}" class="h-[180px] w-full object-cover group-hover:scale-110" alt="">
                    <div class="absolute left-2 bottom-2 text-white">
                        <p>${service.influencer.name}</p>
                        <div>
                            <i class="fa-solid fa-star text-yellow-400"></i>
                            <span>${service.average_rating ?? 'N/A'}</span>
                        </div>
                    </div>
                </div>
                <h3 class="mt-2">${service.title}</h3>
            </a>
        `;
    });
}


</script> --}}

@endpush