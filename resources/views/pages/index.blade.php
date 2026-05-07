@extends('main')

@section('content')
  <main class="index">
    <div class="index__vitrin">
      <div class="title container !text-center !mt-10 md:!mt-16 xl:!mt-20">
        @lang('МЫ ЦЕНИМ КАЖДОГО!</br>МЫ ВЕРИМ В КАЖДОГО! ')
      </div>

      <x-blocks.hot-vacancies class="index__vacancies md:py-10 container" :vacancies="$hotVacancies" />
    </div>

    <x-blocks.categories class="index__categories" :categories="$categories" />

    <x-blocks.stats class="index__stats" />

    <x-blocks.advantages class="index__advantages" />

    <x-blocks.blog class="mb-14" />

    <x-forms.bot-form class="index__advantages" />

    <x-blocks.faq class="index__advantages" />
  </main>
@endsection
