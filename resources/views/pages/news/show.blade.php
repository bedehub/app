@extends('layout.app')

@section('title', $news->title)

@section('content')

<!-- Detail Berita -->
<div class="flex flex-col px-4 lg:px-14 mt-10">
  <div class="font-bold text-xl lg:text-2xl mb-6 text-center lg:text-left">
    <p>{{ $news->title }}</p>
  </div>
  <div class="flex flex-col lg:flex-row w-full gap-10">
    <!-- Berita Utama -->
    <div class="lg:w-8/12">
      <img src="{{ asset('storage/' . $news->thumbnail)}}" 
           alt="{{ $news->title }}" 
           class="w-full max-h-70 rounded-xl object-cover mb-8">
      
      <!-- Sub judul artikel -->
      <h2 class="font-bold text-lg lg:text-xl mb-4">{{ $news->title }}: {{ $news->excerpt ?? 'Kebanggaan Indonesia di Mata Dunia' }}</h2>
      
      <!-- Content artikel -->
      <div class="prose prose-lg max-w-none text-justify leading-relaxed">
        {!! $news->content !!}
      </div>
    </div>
    
    <!-- Sidebar Berita Terbaru -->
    <div class="lg:w-4/12 flex flex-col gap-10">
      <div class="sticky top-24 z-40">
        <p class="font-bold mb-8 text-xl lg:text-2xl">Berita Terbaru Lainnya</p>
        
        <!-- Berita Card -->
        <div class="gap-5 flex flex-col">
          @foreach ($newests as $new)
            <a href="{{ route('news.show', $new->id) }}" class="block">
              <div class="flex gap-3 border border-slate-300 hover:border-primary p-3 rounded-xl transition-all duration-300 hover:shadow-lg relative">
                <!-- Category Badge -->
                <div class="bg-primary text-white rounded-full w-fit px-3 py-1 font-normal text-xs absolute top-3 left-3 z-10">
                  {{ $new->newsCategory->title }}
                </div>
                
                <!-- Content Card -->
                <div class="flex gap-3 flex-col lg:flex-row w-full">
                  <div class="lg:w-1/3">
                    <img src="{{ asset('storage/' . $new->thumbnail) }}" 
                         alt="{{ $new->title }}" 
                         class="w-full h-24 lg:h-20 rounded-xl object-cover">
                  </div>
                  <div class="lg:w-2/3 pt-6 lg:pt-0">
                    <p class="font-bold text-sm lg:text-base line-clamp-2 mb-2">
                      {{ $new->title }}
                    </p>
                    <p class="text-slate-400 text-xs lg:text-sm line-clamp-2">
                      {{ \Str::limit(strip_tags($new->content), 80) }}
                    </p>
                  </div>
                </div>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Author Section -->
<div class="flex flex-col gap-4 mb-10 p-4 lg:p-10 lg:px-14 w-full lg:w-2/3">
  <p class="font-semibold text-xl lg:text-2xl mb-2">Author</p>
  
  @if($news->author)
    <a href="#" class="block">
      <div class="flex flex-col lg:flex-row gap-4 items-center border border-slate-300 rounded-xl p-6 lg:p-8 hover:border-primary transition-all duration-300 hover:shadow-lg">
        <img src="{{ $news->author->avatar ? asset('storage/' . $news->author->avatar) : asset('images/default-avatar.png') }}" 
             alt="{{ $news->author->name }}" 
             class="rounded-full w-24 lg:w-28 h-24 lg:h-28 border-2 border-primary object-cover">
        <div class="text-center lg:text-left">
          <p class="font-bold text-lg lg:text-xl mb-2">{{ $news->author->name }}</p>
          <p class="text-sm lg:text-base leading-relaxed text-slate-600">
            {{ $news->author->bio ? \Str::limit($news->author->bio, 120) : 'Penulis profesional yang berpengalaman dalam dunia jurnalistik.' }}
          </p>
        </div>
      </div>
    </a>
  @else
    <div class="flex flex-col lg:flex-row gap-4 items-center border border-slate-300 rounded-xl p-6 lg:p-8">
      <img src="{{ asset('images/default-avatar.png') }}" 
           alt="Default Author" 
           class="rounded-full w-24 lg:w-28 h-24 lg:h-28 border-2 border-primary object-cover">
      <div class="text-center lg:text-left">
        <p class="font-bold text-lg lg:text-xl mb-2">Admin</p>
        <p class="text-sm lg:text-base leading-relaxed text-slate-600">
          Tim editorial yang berpengalaman dalam menyajikan berita terkini dan terpercaya.
        </p>
      </div>
    </div>
  @endif
</div>

@endsection