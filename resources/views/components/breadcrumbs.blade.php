@props([
    'class' => '',
    'links',
])

<ol class="{{ $class ? "$class " : '' }}breadcrumbs">
  @foreach ($links as $key => $link)
    <li class="breadcrumbs__item">
      <a class="breadcrumbs__link" href="{{ $link[1] }}">
        {{ $link[0] }}

        @if ($key + 1 !== count($links))
          <svg width="6" height="10">
            <use xlink:href="#arrow" />
          </svg>
        @endif
      </a>
    </li>
  @endforeach
</ol>
