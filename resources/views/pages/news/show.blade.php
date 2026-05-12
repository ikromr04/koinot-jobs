@extends('main')

@section('content')
    <main class="team container">
        <h1 class="team__title title">
            {!! $news->translation?->title !!}
        </h1>

        <img class="md:max-w-[80%] mx-auto" src="{{ asset('/storage/' . $news->translation?->image) }}" alt="{{ $news->translation?->title }}">

        <div class="my-10 fi-prose text-[16px]">
            {!! $news->translation?->content !!}
        </div>

        <time class="advantage-card__time" datetime="2025-08-30">
            <svg class="text-primary" width="12" height="14">
                <use xlink:href="#calendar" />
            </svg>
            {{ \Carbon\Carbon::parse($news->date)->translatedFormat('d F Y') }}
        </time>
    </main>
@endsection
