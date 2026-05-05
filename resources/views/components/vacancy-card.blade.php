@props(['vacancy'])

<article {{ $attributes->merge(['class' => 'vacancy-card']) }}>
    <div class="vacancy-card__title">{!! $vacancy->translation->title !!}</div>

    <div class="vacancy-card__address">
        <div>
            <img class="max-w-full max-h-10" src="{{ $vacancy->company->translation->logo }}">
        </div>

        <a class="vacancy-card__more" href="{{ route('pages.vacancy', $vacancy->id) }}">
            @lang('Подробнее')
        </a>
    </div>
</article>
