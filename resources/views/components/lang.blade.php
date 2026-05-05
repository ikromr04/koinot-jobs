@props(['class' => ''])

<div class="{{ $class ? "$class " : '' }}lang">
  <button class="lang__toggler" type="button">
    <span>@lang('Смена языка')</span>
    <span class="flex items-center gap-1 pr-3 xl:gap-3">
      {{ app()->getLocale() }}
      <svg class="flex text-grey" width="12" height="6">
        <use xlink:href="#caret-down" />
      </svg>
    </span>
  </button>

  <ul class="lang__list">
    @foreach (config('app.available_locales') as $locale)
      <li class="lang__item">
        <a class="lang__link{{ $locale === app()->getLocale() ? ' lang__link--current' : '' }}" href="{{ $locale !== config('app.fallback_locale') ? "/$locale" : '' }}/{{ preg_replace('#^(en)/#', '', request()->path()) }}">
          {{ $locale }}
          @if ($locale === app()->getLocale())
            <svg width="11" heigh="8">
              <use xlink:href="#check" />
            </svg>
          @endif
        </a>
      </li>
    @endforeach
  </ul>
</div>
