@props(['class' => ''])

<form class="{{ $class ? "$class " : '' }}search" action="">
  @csrf

  <p class="search__item">
    <label class="sr-only" for="vacancy">@lang('Вакансия')</label>
    <svg width="15" height="15">
      <use xlink:href="#search" />
    </svg>
    <input class="search__input" id="vacancy" type="text" placeholder="@lang('Вакансия')">
  </p>

  <button class="search__submit" type="submit">
    @lang('Поиск')
  </button>
</form>
