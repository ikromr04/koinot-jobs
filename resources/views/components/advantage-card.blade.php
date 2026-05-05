@props([
    'class' => '',
    'advantage',
])

<article class="{{ $class ? "$class " : '' }}advantage-card">
  <img class="advantage-card__image" src="{{ asset($advantage->image) }}" width="326" height="217" alt="{{ $advantage->title }}">

  <div class="advantage-card__inner">
    <h3 class="advantage-card__title">{{ $advantage->title }}</h3>

    <time class="advantage-card__time" datetime="2025-08-30">
      <svg class="text-primary" width="12" height="14">
        <use xlink:href="#calendar" />
      </svg>
      August 30, 2025
    </time>

    <p class="advantage-card__description">
      There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
    </p>

    <a class="advantage-card__link no-underline" @if($advantage?->route) href="{{ route($advantage->route) }}" @endif>
      @lang('Читать')
    </a>
  </div>
</article>
