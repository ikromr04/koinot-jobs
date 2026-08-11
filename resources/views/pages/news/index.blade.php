@extends('main')

@section('meta')
    <meta name="description" content="@lang('Найдите работу своей мечты на карьерном портале «КОИНОТИ НАВ». Актуальные вакансии, резюме, работодатели и новые возможности для успешной карьеры в Таджикистане.')">
    <meta property="og:description" content="@lang('Найдите работу своей мечты на карьерном портале «КОИНОТИ НАВ». Актуальные вакансии, резюме, работодатели и новые возможности для успешной карьеры в Таджикистане.')">
    <meta property="og:title" content="@lang('Карьерный портал «КОИНОТИ НАВ»')">
    <meta property="og:url" content="{{ route('pages.news') }}">
    <meta property="og:image" content="{{ asset('images/og.svg') }}">
    <link rel="canonical" href="{{ route('pages.news') }}">
@endsection

@section('content')
    <main class="index container py-26">
        <x-blocks.blog :blog="$blog" />

        <div class="flex items-center justify-between -mt-14!">
            <h1 class="title">
                @lang('Все новости')
            </h1>

            <div class="flex gap-4">
                <a class="flex items-center justify-center h-10 px-5 rounded-full {{ request()->query('sort') == 'desc' ? 'text-[#73787D] bg-[#EAECF4]' : 'text-white bg-[#3B4663]' }}" href="?sort=asc">
                    @lang('Новые новости')
                </a>
                <a class="flex items-center justify-center h-10 px-5 rounded-full {{ request()->query('sort') != 'desc' ? 'text-[#73787D] bg-[#EAECF4]' : 'text-white bg-[#3B4663]' }}" href="?sort=desc">
                    @lang('Старые новости')
                </a>
            </div>
        </div>

        <ul class="advantages__list">
            @foreach ($news as $new)
                <li class="advantages__item">
                    <x-advantage-card :news="$new" />
                </li>
            @endforeach
        </ul>
    </main>
@endsection
