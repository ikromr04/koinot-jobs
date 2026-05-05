@extends('main')

@section('content')
  <main class="resume container">
    <h1 class="sr-only">@lang('Резюме')</h1>

    <x-forms.resume-form class="resume__form" />
  </main>
@endsection
