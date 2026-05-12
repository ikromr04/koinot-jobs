@extends('main')

@section('content')
    <main class="index">
        <div class="index__vitrin">
            <div class="title container !text-center !mt-10 md:!mt-16 xl:!mt-20">
                @lang('МЫ ЦЕНИМ КАЖДОГО!</br>МЫ ВЕРИМ В КАЖДОГО!')
            </div>

            <x-blocks.hot-vacancies class="index__vacancies md:py-10 container" :vacancies="$hotVacancies" />
        </div>

        <x-blocks.categories class="index__categories" :categories="$categories" />

        <section class="index__stats stats container">
            <h2 class="sr-only">
                @lang('Мы в цифрах')
            </h2>

            <div class="stats__info">
                {!! $numbers->translation?->title !!}
            </div>

            <div class="stats__details fi-prose">
                {!! $numbers->translation?->content !!}
            </div>
        </section>

        <section class="index__advantages advantages container" id="career">
            <h2 class="title">
                @lang('Что делает нас особенными')
            </h2>

            <ul class="advantages__list">
                @foreach ($news as $new)
                    <li class="advantages__item">
                        <x-advantage-card :news="$new" />
                    </li>
                @endforeach
            </ul>
        </section>

        <x-blocks.blog :blog="$blog" class="mb-14" />

        <x-forms.bot-form class="index__advantages" />

        <x-blocks.faq class="index__advantages" />
    </main>
@endsection
