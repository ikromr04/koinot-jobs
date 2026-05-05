@props(['class' => ''])

<ul class="{{ $class ? "$class " : '' }}socials">
  <li class="socials__item">
    <a class="socials__link" href="https://www.facebook.com/share/1DQabZvr3M/?mibextid=wwXIfr" target="_blank">
      <svg class="socials__icon" width="10" height="17">
        <use xlink:href="#facebook" />
      </svg>
    </a>
  </li>
  <li class="socials__item">
    <a class="socials__link" href="https://www.instagram.com/koinotinav?igsh=bXBzcDFrbG10ejNs" target="_blank">
      <svg class="socials__icon" width="21" height="21">
        <use xlink:href="#instagram" />
      </svg>
    </a>
  </li>
  <li class="socials__item">
    <a class="socials__link" href="https://www.linkedin.com/company/koinoti-nav/" target="_blank">
      <svg class="socials__icon" width="15" height="15">
        <use xlink:href="#linkedin" />
      </svg>
    </a>
  </li>
  <li class="socials__item">
    <a class="socials__link" href="https://www.youtube.com/@KOINOTLIVE" target="_blank">
      <svg class="socials__icon" width="18" height="13">
        <use xlink:href="#youtube" />
      </svg>
    </a>
  </li>
</ul>
