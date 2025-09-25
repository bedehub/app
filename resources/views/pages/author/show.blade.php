@extends('layout.app')

@section('title', $author->name)

@section('content')
     <!-- Author -->
    <div class="flex gap-4 items-center mb-10 text-white p-10 bg-cover"
        style="background-image: url('{{ asset('assets/img/bg-profil.png') }}');">
      <img src="{{ asset('storage/' . $author->avatar) }}" alt="profile" class="rounded-full max-w-28">
      <div class="">
        <p class="font-bold text-lg">{{ $author->name }}</p>
        <p> 
            {{ $author->bio }}
        </p>
      </div>
    </div>

    <!-- Berita -->
    <div class="flex flex-col gap-5 px-4 lg:px-14">
      @if($author->news && $author->news->count() > 0)
        @foreach($author->news->chunk(4) as $newsChunk)
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
          @foreach($newsChunk as $news)
            <a href="{{ route('news.show', $news->id) }}">
              <div class="border border-slate-200 p-3 rounded-xl hover:border-primary hover:cursor-pointer transition duration-300 ease-in-out">
                <div class="bg-primary text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                  {{ $news->newsCategory->title ?? 'Umum' }}
                </div>
                <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="w-full rounded-xl mb-3">
                <p class="font-bold text-base mb-1">{{ $news->title }}</p>
                <p class="text-slate-400">{{ $news->created_at->format('d M Y') }}</p>
              </div>
            </a>
          @endforeach
        </div>
        @endforeach
      @else
        <!-- Default content jika tidak ada berita -->
        <div class="grid sm:grid-cols-1 gap-5 lg:grid-cols-4">
          <a href="#" class="pointer-events-none">
            <div class="border border-slate-200 p-3 rounded-xl">
              <div class="bg-gray-300 text-white rounded-full w-fit px-5 py-1 font-normal ml-2 mt-2 text-sm absolute">
                No Category
              </div>
              <div class="w-full h-48 bg-gray-200 rounded-xl mb-3 flex items-center justify-center">
                <span class="text-gray-400">No Image</span>
              </div>
              <p class="font-bold text-base mb-1 text-gray-400">Belum ada berita tersedia</p>
              <p class="text-slate-400">-</p>
            </div>
          </a>
        </div>
      @endif

      <!-- Pagination -->
      @if($author->news && $author->news->count() > 4)
      <div class="w-full flex items-center justify-center gap-3 pt-12 mb-10">
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium text-slate-300 hover:cursor-pointer">&lt;</p>
        <p class="rounded-lg px-4 py-2 font-medium bg-primary text-white hover:bg-slate-300 hover:text-black hover:cursor-pointer">
          1</p>
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          2</p>
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          3</p>
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:cursor-pointer">...</p>
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          10</p>
        <p class="border border-slate-300 rounded-lg px-4 py-2 font-medium hover:bg-primary hover:border-none hover:text-white hover:cursor-pointer">
          ></p>
      </div>
      @endif
    </div>

@endsection