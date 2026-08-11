@extends('main')

@section('meta')
    <meta name="description" content="{{ strip_tags($vacancy->translation?->description) }}">
    <meta property="og:description" content="{{ strip_tags($vacancy->translation?->description) }}">
    <meta property="og:title" content="{{ strip_tags($vacancy->translation?->title) }}">
    <meta property="og:url" content="{{ route('pages.vacancy', $vacancy->id) }}">
    <meta property="og:image" content="{{ asset('images/og.jpg') }}">
    <link rel="canonical" href="{{ route('pages.vacancy', $vacancy->id) }}">
@endsection

@section('content')
    <main class="vacancy container">
        <x-search class="vacancies__search" />

        <x-breadcrumbs class="vacancy__breadcrumbs" :links="[[__('Все вакансии'), route('pages.vacancies')], [strip_tags($vacancy->translation?->title), '']]" />

        <h1 class="vacancy__title title">{{ strip_tags($vacancy->translation?->title) }}</h1>

        <div class="flex flex-col gap-10 bg-primary/5 py-20 px-10 lg:flex-row mb-20">
            <div>
                <p class="flex mt-0 mb-5 text-[#73787D] text-[14px] gap-2">
                    <svg width="16" height="20">
                        <use xlink:href="#location" />
                    </svg>
                    {{ $vacancy->translation?->city }}
                </p>

                <div class="no-style">
                    {!! $vacancy->translation?->content !!}
                </div>
            </div>

            <x-forms.resume-form class="lg:min-w-[480px] lg:max-w-[480px] h-max" />
        </div>

        <x-blocks.similar-vacancies class="mb-10" :vacancies="$vacancies" />
    </main>
@endsection
