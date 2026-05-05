@extends('main')

@php
  $team = [
      (object) [
          'image' => '/images/team.jpg',
          'title' => 'Наша команда',
      ],
      (object) [
          'image' => '/images/team.jpg',
          'title' => 'Наши достижения',
      ],
      (object) [
          'image' => '/images/team.jpg',
          'title' => 'Наша Корпоративная культура',
      ],
  ];
@endphp

@section('content')
  <main class="team container">
    <h1 class="team__title title">@lang('Наш тим')</h1>

    <x-search class="team__search" />

    <p class="team__desc">
      Тут Можем добавить наши тимбилдинги мероприятий и так далее
    </p>

    <ul class="team__list">
      @foreach ($team as $item)
        <li class="team__item">
          <x-team-card :team="$item" />
        </li>
      @endforeach
    </ul>
  </main>
@endsection
