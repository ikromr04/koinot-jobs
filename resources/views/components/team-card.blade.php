@props([
    'class' => '',
    'team',
])

<article class="{{ $class ? "$class " : '' }} team-card">
  <img class="team-card__image" src="{{ asset($team->image) }}" width="388" height="357" alt="{{ $team->title }}">

  <h3 class="team-card__title">{{ $team->title }}</h3>

  <p class="team-card__desc">
    There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
  </p>
</article>
