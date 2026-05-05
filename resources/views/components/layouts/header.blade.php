<header class="header">
  <nav class="header__nav container">
    <button class="header__toggler" type="button">
      <span class="sr-only">@lang('Скрыть/Показать меню')</span>
      <svg width="18" height="16">
        <use xlink:href="#menu" />
      </svg>
      <svg width="12" height="12">
        <use xlink:href="#close" />
      </svg>
    </button>

    <x-lang class="header__lang" />

    <a class="header__logo" href="{{ route('pages.index') }}">
      <img src="{{ asset('images/logo.svg') }}" width="215" height="26" alt="@lang('На главную')">
    </a>

    <ul class="header__list">
      <li class="header__item">
        <a class="header__navlink{{ request()->routeIs('pages.index') ? ' header__navlink--current' : '' }}" href="{{ route('pages.index') }}">
          @lang('Главная')
        </a>
      </li>
      <li class="header__item">
        <a class="header__navlink{{ request()->routeIs('pages.vacancies') ? ' header__navlink--current' : '' }}" href="{{ route('pages.vacancies') }}">
          @lang('Все вакансии')
        </a>
      </li>
      <li class="header__item">
        <a class="header__navlink" href="{{ route('pages.index') }}#categories">
          @lang('Категории')
        </a>
      </li>
      <li class="header__item">
        <a class="header__navlink" href="{{ route('pages.index') }}#career">
          @lang('Карьерный рост')
        </a>
      </li>
      <li class="header__item">
        <a class="header__navlink" href="#contacts">
          @lang('Контакты')
        </a>
      </li>
    </ul>

    <a class="header__resume" href="{{ route('pages.resume') }}">@lang('Шаблон')</a>

    <div class="header__bottom">
      <div class="header__links">
        <a class="header__link" href="blank" target="_blank">
          @lang('Политика конфиденциальности')
        </a>
        <a class="header__link" href="blank" target="_blank">
          @lang('Условия эксплуатации')
        </a>
      </div>

      <x-socials class="header__socials" />
    </div>
  </nav>
</header>
