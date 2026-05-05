@props(['categories'])

<section {{ $attributes->merge(['class' => 'categories']) }} id="categories">
    <h2 class="categories__title title container">@lang('Категории')</h2>

    <ul class="categories__list">
        @foreach ($categories as $category)
            <li class="categories__item">
                <a class="cagtegories__link" href="{{ route('pages.category', $category->id) }}">
                    {!! $category->icon !!}
                    {{ $category->translation->name }}
                    <svg width="12" height="10">
                        <use xlink:href="#goto" />
                    </svg>
                </a>
            </li>
        @endforeach
    </ul>
</section>
