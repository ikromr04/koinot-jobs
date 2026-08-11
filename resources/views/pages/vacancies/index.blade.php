@extends('main')

@section('meta')
    <meta name="description" content="@lang('Найдите работу своей мечты на карьерном портале «КОИНОТИ НАВ». Актуальные вакансии, резюме, работодатели и новые возможности для успешной карьеры в Таджикистане.')">
    <meta property="og:description" content="@lang('Найдите работу своей мечты на карьерном портале «КОИНОТИ НАВ». Актуальные вакансии, резюме, работодатели и новые возможности для успешной карьеры в Таджикистане.')">
    <meta property="og:title" content="@lang('Карьерный портал «КОИНОТИ НАВ»')">
    <meta property="og:url" content="{{ route('pages.vacancies') }}">
    <meta property="og:image" content="{{ asset('images/og.jpg') }}">
    <link rel="canonical" href="{{ route('pages.vacancies') }}">
@endsection

@section('content')
    <main class="vacancies container">
        <h1 class="vacancies__title title" id="vacancies">@lang('Все вакансии')</h1>

        <x-search class="vacancies__search" />

        <div class="vacancies__inner">
            <div>
                <ul class="vacancies__list">
                    @foreach ($vacancies as $vacancy)
                        <li class="vacancies__item">
                            <a class="vacancies__link" href="{{ route('pages.vacancy', $vacancy->id) }}">
                                <img class="vacancies__logo" src="{{ asset('/storage/' . $vacancy->company?->translation?->logo) }}" alt="{{ $vacancy->company?->translation?->title }}">

                                <div class="vacancies__heading">{!! $vacancy->translation->title !!}</div>
                                <div class="vacancies__desc">{{ preg_replace('/[^\p{L}\p{N}\s\.,!?-]/u', '', strip_tags($vacancy->translation->description)) }}</div>

                                <p class="vacancies__city">
                                    <svg width="16" height="20">
                                        <use xlink:href="#location" />
                                    </svg>
                                    {{ $vacancy->translation->city }}
                                </p>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="vacancies__pagination">
                    {{ $vacancies->fragment('vacancies')->links('components.pagination') }}
                </div>
            </div>

            <aside class="vacancies__filter">
                <h2>@lang('Подберите вакансию и компанию!')</h2>

                <form>
                    <label class="sr-only" for="city">@lang('Город')</label>
                    <select name="city" id="city">
                        <option value="">@lang('Все города')</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" @if (request()->query('city') == $city) selected @endif>{{ $city }}</option>
                        @endforeach
                    </select>

                    <fieldset>
                        <legend>@lang('Сфера')</legend>

                        <ul>
                            @foreach ($categories as $category)
                                <li>
                                    <input
                                        id="{{ $category->translation->name }}"
                                        type="checkbox"
                                        value="{{ $category->id }}"
                                        data-type="category"
                                        @checked(in_array($category->id, explode(',', request()->query('category', ''))))
                                    >

                                    <label for="{{ $category->translation->name }}">
                                        {{ $category->translation->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </fieldset>

                    <fieldset>
                        <legend>@lang('Компании')</legend>

                        @php
                            $selectedCompanies = explode(',', request()->query('company', ''));
                        @endphp

                        <ul>
                            @foreach ($companies as $company)
                                <li>
                                    <input
                                        id="{{ $company->translation->name }}"
                                        type="checkbox"
                                        value="{{ $company->id }}"
                                        data-type="company"
                                        @checked(in_array($company->id, $selectedCompanies))
                                    >

                                    <label for="{{ $company->translation->name }}">
                                        {{ $company->translation->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </fieldset>

                    <button class="font-bold text-[17px] text-[#C4C9CE] bg-transparent border-none flex justify-center items-center min-h-14 cursor-pointer" type="reset">
                        @lang('Сбросить все')
                    </button>
                </form>
            </aside>
        </div>
    </main>
@endsection
