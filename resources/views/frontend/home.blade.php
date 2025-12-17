@extends('layouts.app')

@section('content')
  <h2 class="text-xl font-bold mb-4 border-b-2 border-blue-500">Artikel Terkini</h2>

  @foreach($articles as $article)
    <div class="bg-white rounded-xl shadow p-4 mb-4">
      @if($article->image)
        <img src="{{ asset('storage/'.$article->image) }}" class="w-full rounded-lg mb-2">
      @endif
      <h3 class="text-lg font-semibold text-blue-700">{{ $article->title }}</h3>
      <p class="text-sm text-gray-500">{{ $article->date }} | {{ $article->author }}</p>
      <p class="mt-2 text-gray-700">{{ Str::limit($article->content, 150) }}</p>
    </div>
  @endforeach
@endsection
