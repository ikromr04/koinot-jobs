@props(['class' => ''])

@php
  $advantages = [
      (object) [
          'image' => '/images/advantages/adv-1.jpg',
          'title' => 'Корпоративная культура',
          'route' => null
      ],
      (object) [
          'image' => '/images/advantages/adv-2.jpg',
          'title' => 'Карьерный рост',
          'route' => null
      ],
      (object) [
          'image' => '/images/advantages/adv-3.jpg',
          'title' => 'Тимбилдинги',
          'route' => 'pages.teambuilding'
      ],
  ];
@endphp

<section class="{{ $class ? "$class " : '' }}advantages container" id="career">
  <h2 class="title">@lang('Что делает нас особенными')</h2>

  <ul class="advantages__list">
    @foreach ($advantages as $advantage)
      <li class="advantages__item">
        <x-advantage-card :advantage="$advantage" />
      </li>
    @endforeach
  </ul>
</section>
