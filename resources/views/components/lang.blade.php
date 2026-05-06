<div {{ $attributes->merge(['class' => 'lang']) }}>
    <button class="lang__toggler" type="button">
        <span>@lang('Смена языка')</span>
        <span class="flex items-center gap-1 pr-3 xl:gap-3">
            {{ app()->getLocale() }}
            <svg class="flex text-grey" width="12" height="6">
                <use xlink:href="#caret-down" />
            </svg>
        </span>
    </button>

    @php
        $currentLocale = app()->getLocale();
        $defaultLocale = 'ru';
    @endphp

    <ul class="lang__list">
        @foreach (config('app.available_locales') as $locale)
            @php
                $segments = request()->segments();

                if ($locale === $defaultLocale) {
                    array_shift($segments);
                    $href = '/' . implode('/', $segments);
                } else {
                    $href = "/{$locale}/" . implode('/', $segments);
                    $href = rtrim($href, '/');
                }
            @endphp
            <li class="lang__item">
                <a class="lang__link{{ $locale === $currentLocale ? ' lang__link--current' : '' }}" @if($locale !== $currentLocale) href="{{ $href }}" @endif>
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
