@props([
    'class' => '',
    'vacancies',
])

<section class="{{ $class ? "$class " : '' }}similar-vacancies">
  <h2 class="similar-vacancies__title title">
    @lang('Похожие вакансии по вашему запросу'):
  </h2>

  <ul class="list-none p-0 m-0 grid gap-10 md:grid-cols-2 lg:grid-cols-3">
    @foreach ($vacancies as $vacancy)
      <li class="flex">
        <a class="flex flex-col text-inherit no-underline py-8 px-6 border rounded-[20px] border-[#C4C9CE]" href="{{ route('pages.vacancy', $vacancy->id) }}">
          <div class="vacancy-card__title !text-[20px] font-bold">{{ strip_tags($vacancy->title)}}</div>
          <div class="vacancy-card__description">{{ preg_replace('/[^\p{L}\p{N}\s\.,!?-]/u', '', strip_tags($vacancy->description)) }}</div>

          <div class="flex justify-between items-center mt-auto">
            <div class="flex items-center gap-2 text-[14px] text-[#73787D]">
              <svg class="text-primary" width="16" height="20">
                <use xlink:href="#location" />
              </svg>
              {{ $vacancy->city }}
            </div>
            <div class="flex items-center gap-2">
              <img class="w-[80px] h-6 object-contain" src="{{ asset($vacancy->company?->logo) }}" width="80" height="24" alt="{{ $vacancy->company?->title }}">
            </div>
          </div>
        </a>
      </li>
    @endforeach
  </ul>
</section>
