@props(['vacancies'])

<section {{ $attributes->merge(['class' => 'hot-vacancies']) }}>
    <h2 class="hot-vacancies__title title xl:!text-3xl">@lang('Наши горячие вакансии! Успейте разобрать)')</h2>

    <ul class="hot-vacancies__list">
        @foreach ($vacancies as $vacancy)
            <li class="hot-vacancies__item">
                <x-vacancy-card :vacancy="$vacancy" />
            </li>
        @endforeach
    </ul>
</section>
