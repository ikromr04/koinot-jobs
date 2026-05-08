@extends('main')

@section('content')
    <main class="index container py-26">
        <x-blocks.blog />

        <div class="flex items-center justify-between -mt-14!">
            <h1 class="title">
                @lang('Все новости')
            </h1>

            <div class="flex gap-4">
                <a class="flex items-center justify-center h-10 px-5 rounded-full {{ request()->query('sort') == 'desc' ? 'text-[#73787D] bg-[#EAECF4]' : 'text-white bg-[#3B4663]' }}" href="?sort=asc">
                    Новые новости
                </a>
                <a class="flex items-center justify-center h-10 px-5 rounded-full {{ request()->query('sort') != 'desc' ? 'text-[#73787D] bg-[#EAECF4]' : 'text-white bg-[#3B4663]' }}" href="?sort=desc">
                    Старые Новости
                </a>
            </div>
        </div>

        <div class="flex flex-col gap-8">
            @foreach ($news as $item)
                <article class="rounded-3xl bg-primary/5 p-6 flex gap-6">
                    <img class="flex rounded-[20px] w-[264px] h-[288px] object-cover" src="{{ asset('/storage/' . $item->translation?->image) }}" alt="News image">

                    <div class="flex flex-col">
                        <div class="text-[24px] mb-4">
                            {!! $item->translation?->title !!}
                        </div>

                        <div>
                            {!! $item->translation?->content !!}
                        </div>

                        <div class="text-[#73787D] mt-auto">
                            {{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </main>
@endsection
