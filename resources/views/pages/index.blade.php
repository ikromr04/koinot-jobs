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

        <section class="container" id="career">
            <h2 class="title text-center!">
                @lang('Вопросы и ответы')
            </h2>

            <div id="accordion-collapse" data-accordion="collapse" class="rounded-[10px] border border-gray-300 overflow-hidden shadow-xs mb-10 md:mb-20">
                @foreach ($faqs as $faq)
                    <h2 id="accordion-collapse-heading-{{ $faq->id }}">
                        <button
                            type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-body rounded-t-base border border-t-0 border-x-0 border-b-gray-300 hover:text-heading hover:bg-neutral-secondary-medium gap-3"
                            data-accordion-target="#accordion-collapse-body-{{ $faq->id }}"
                            aria-expanded="false"
                            aria-controls="accordion-collapse-body-{{ $faq->id }}"
                        >
                            <span class="text-[18px]">
                                <span class="no-style">
                                    {{ strip_tags($faq->translation->question) }}
                                </span>
                            </span>
                            <svg
                                data-accordion-icon
                                class="w-5 h-5 rotate-180 shrink-0"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                fill="none"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m5 15 7-7 7 7"
                                />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-{{ $faq->id }}" class="hidden border border-s-0 border-e-0 border-t-0 border-b-gray-300" aria-labelledby="accordion-collapse-heading-{{ $faq->id }}">
                        <div class="p-4 md:p-5">
                            <div class="no-style">
                                {!! $faq->translation->answer !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </main>
@endsection
