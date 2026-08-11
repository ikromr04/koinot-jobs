@extends('main')

@section('meta')
    <meta name="description" content="@lang('Найдите работу своей мечты на карьерном портале «КОИНОТИ НАВ». Актуальные вакансии, резюме, работодатели и новые возможности для успешной карьеры в Таджикистане.')">
    <meta property="og:description" content="@lang('Найдите работу своей мечты на карьерном портале «КОИНОТИ НАВ». Актуальные вакансии, резюме, работодатели и новые возможности для успешной карьеры в Таджикистане.')">
    <meta property="og:title" content="@lang('Карьерный портал «КОИНОТИ НАВ»')">
    <meta property="og:url" content="{{ route('pages.category', $category->id) }}">
    <meta property="og:image" content="{{ asset('images/og.svg') }}">
    <link rel="canonical" href="{{ route('pages.category', $category->id) }}">
@endsection

@section('content')
    <main class="category container">
        <x-breadcrumbs class="category__breadcrumbs" :links="[[__('Категории'), route('pages.index') . '#categories'], [$category->translation?->name, '']]" />

        <h1 class="category__title title">
            {{ $category->translation?->name }}
        </h1>

        <ul class="category__list">
            @foreach ($vacancies as $vacancy)
                <li class="category__item">
                    <a class="flex flex-col border border-[#C4C9CE] rounded-[24px] no-underline text-inherit py-5 px-10 md:flex-row md:gap-10 md:items-center md:py-10" href="{{ route('pages.vacancy', $vacancy->id) }}">
                        <img
                            class="flex object-contain h-10 w-auto mb-4 md:w-[180px] md:h-auto md:mx-10"
                            src="{{ asset($vacancy->company?->translation?->logo) }}"
                            width="180"
                            height="40"
                            alt="{{ $vacancy->title }}"
                        >

                        <div class="md:grow">
                            <div class="vacancy-card__title">{!! $vacancy->translation?->title !!}</div>
                            <div class="vacancy-card__description">{{ preg_replace('/[^\p{L}\p{N}\s\.,!?-]/u', '', strip_tags($vacancy->translation?->description)) }}</div>

                            <div class="flex items-center justify-between md:mt-10">
                                <p class="m-0 text-[#374151]">(14 откликов)</p>
                                <p class="m-0 text-[#374151]">
                                    <span class="font-medium">5000с</span> / договорная
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </main>
@endsection
