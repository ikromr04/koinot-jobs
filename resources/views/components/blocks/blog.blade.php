@props(['blog'])

<section class="container" id="career">
    @if (!request()->routeIs('pages.news'))
        <h2 class="title">@lang('Наш блог :)')</h2>
    @endif

    <section class="bg-[#3B4663] p-6 rounded-4xl mb-32 text-white flex flex-wrap gap-6 items-center md:grid md:grid-cols-[60%_1fr] md:py-6 md:px-10">
        <div class="flex flex-col justify-start items-start">
            <h3 class="m-0 mb-4 text-[20px] font-semibold md:text-[40px]">
                {!! $blog->translation?->title !!}
            </h3>
            <div class="mt-0 mb-8 text-[16px] md:text-[24px] fi-prose text-white">
                {!! $blog->translation?->content !!}
            </div>

            @if (!request()->routeIs('pages.news'))
                <a class="vacancy-card__more rounded-full!" href="{{ route('pages.news') }}">
                    @lang('Подробнее')
                </a>
            @endif
        </div>

        <div class="-order-1 flex w-full md:order-0">
            <img class="flex w-full h-auto rounded-[10px]" src="{{ asset('/storage/'.$blog->translation?->image) }}" alt="Blog">
        </div>
    </section>
</section>
