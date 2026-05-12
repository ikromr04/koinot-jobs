@props(['blog'])

<section class="container" id="career">
    @if (!request()->routeIs('pages.news'))
        <h2 class="title">@lang('Наш блог :)')</h2>
    @endif

    <section class="bg-[#3B4663] py-6 px-11 rounded-4xl mb-32 text-white flex gap-10 items-center">
        <div class="max-w-[60%] flex flex-col justify-start items-start">
            <h3 class="m-0 mb-4 text-[40px] font-semibold">
                {!! $blog->translation?->title !!}
            </h3>
            <div class="mt-0 mb-20 text-[24px] fi-prose text-white">
                {!! $blog->translation?->content !!}
            </div>

            @if (!request()->routeIs('pages.news'))
                <a class="vacancy-card__more rounded-full!" href="{{ route('pages.news') }}">
                    @lang('Подробнее')
                </a>
            @endif
        </div>

        <div>
            <img class="flex w-full h-auto" src="{{ asset('/storage/'.$blog->translation?->image) }}" alt="Blog">
        </div>
    </section>
</section>
