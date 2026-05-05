@extends('main')

@section('content')
  <main class="category container">
    <x-breadcrumbs class="category__breadcrumbs" :links="[[__('Категории'), route('pages.index') . '#categories'], [$data->category->name, '']]" />

    <h1 class="category__title title">
      {{ $data->category->name }}
    </h1>

    <ul class="category__list">
      @foreach ($data->vacancies as $vacancy)
        <li class="category__item">
          <a class="flex flex-col border border-[#C4C9CE] rounded-[24px] no-underline text-inherit py-5 px-10 md:flex-row md:gap-10 md:items-center md:py-10" href="{{ route('pages.vacancy', $vacancy->id) }}">
            <img class="flex object-contain h-10 w-auto mb-4 md:w-[180px] md:h-auto md:mx-10" src="{{ asset($vacancy->company->logo) }}" width="180" height="40" alt="{{ $vacancy->title }}">

            <div class="md:grow">
              <div class="vacancy-card__title">{!! $vacancy->title !!}</div>
              <div class="vacancy-card__description">{{ preg_replace('/[^\p{L}\p{N}\s\.,!?-]/u', '', strip_tags($vacancy->description)) }}</div>

              <div class="flex items-center justify-between md:mt-10">
                <p class="m-0 text-[#374151]">(14 откликов)</p>
                <p class="m-0 text-[#374151]">
                  <span class="font-medium">5000с</span> / договорная
                </p>
              </div>
            </div>
          </a>
        </li>
      @endforeach
    </ul>
  </main>
@endsection
