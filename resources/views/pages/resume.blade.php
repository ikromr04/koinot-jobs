@extends('main')

@section('meta')
    <meta name="description" content="@lang('Отклик на вакансию.')">
    <meta property="og:description" content="@lang('Отклик на вакансию.')">
    <meta property="og:title" content="@lang('Карьерный портал «КОИНОТИ НАВ»')">
    <meta property="og:url" content="{{ route('pages.resume') }}">
    <meta property="og:image" content="{{ asset('images/og.svg') }}">
    <link rel="canonical" href="{{ route('pages.resume') }}">
@endsection

@section('content')
    <main class="resume container">
        <h1 class="sr-only">@lang('Резюме')</h1>

        <x-forms.resume-form class="resume__form" />
    </main>
@endsection
