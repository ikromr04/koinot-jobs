@props([
    'class' => '',
    'news',
])

<article class="{{ $class ? "$class " : '' }}advantage-card">
    <img
        class="advantage-card__image"
        src="{{ asset('/storage/' . $news->translation?->image) }}"
        width="326"
        height="217"
        alt="{{ $news->translation?->title }}"
    >

    <div class="advantage-card__inner">
        <h3 class="advantage-card__title">
            {!! $news->translation?->title !!}
        </h3>

        <time class="advantage-card__time" datetime="2025-08-30">
            <svg class="text-primary" width="12" height="14">
                <use xlink:href="#calendar" />
            </svg>
            {{ \Carbon\Carbon::parse($news->date)->translatedFormat('d F Y') }}
        </time>

        <div class="advantage-card__description">
            {{ $news->translation?->description }}...
        </div>

        <a class="advantage-card__link no-underline" href="{{ route('news.show', $news->id) }}">
            @lang('Читать')
        </a>
    </div>
</article>
