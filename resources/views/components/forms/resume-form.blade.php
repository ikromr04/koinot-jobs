@props(['class' => ''])

<form class="{{ $class ? "$class " : '' }}resume-form">
  <h1 class="resume-form__title">@lang('Отклик на вакансию')</h1>

  <p class="resume-form__item">
    <label class="resume-form__label">
      <span class="sr-only">@lang('Имя и фамилия')</span>
      <input class="resume-form__input" name="name" type="text" placeholder="@lang('Имя и фамилия')" required>
    </label>
  </p>

  <p class="resume-form__item resume-form__item--date">
    <label class="resume-form__label">
      <input class="resume-form__input" name="birthdate" type="date" onclick="this.showPicker?.()" required>
      <span>@lang('Дата рождения')</span>
    </label>
  </p>

  <p class="resume-form__item">
    <label class="resume-form__label">
      <span class="sr-only">@lang('Номер телефона')</span>
      <input class="resume-form__input" name="phone" type="number" placeholder="@lang('Номер телефона')" required>
    </label>
  </p>

  <p class="resume-form__item">
    <label class="resume-form__label">
      <span class="sr-only">Email</span>
      <input class="resume-form__input" name="email" type="email" placeholder="Email" required>
    </label>
  </p>

  <p class="resume-form__item">
    <label class="resume-form__label">
      <span class="sr-only">@lang('Город')</span>
      <input class="resume-form__input" name="city" type="text" placeholder="@lang('Город')" required>
    </label>
  </p>

  <p class="resume-form__item">
    <label class="resume-form__label">
      <span class="sr-only">@lang('О себе')</span>
      <textarea class="resume-form__textarea" name="about" placeholder="@lang('Расскажите о себе и почему хотите присоединиться')" cols="30" rows="10"></textarea>
    </label>
  </p>

  <p class="resume-form__item resume-form__item--file">
    <label class="resume-form__label">
      <span>
        <svg width="20" height="20">
          <use xlink:href="#add" />
        </svg>
        <span data-label="@lang('Загрузить резюме') (docx, doc, PDF)">
          @lang('Загрузить резюме') (docx, doc, PDF)
        </span>
      </span>
      <input class="sr-only" name="resume" type="file" accept=".doc,.docx,.pdf">
    </label>

    <span>@lang('или')</span>

    <a href="https://www.cvwizard.com/app/resumes" target="_blank">
      @lang('Создать резюме')
    </a>
  </p>

  <button class="resume-form__submit group" type="submit" data-label="@lang('Откликнуться')">
    <span class="group-[.submitting]:hidden group-[.success]:hidden">@lang('Откликнуться')</span>
    <svg aria-hidden="true" class="hidden group-[.submitting]:inline w-6 h-6 text-white animate-spin dark:text-gray-400 fill-white" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
    </svg>
    <svg class="hidden group-[.success]:inline w-7 h-7 text-green-300" xmlns="http://www.w3.org/2000/svg" width="800" height="800" viewBox="0 0 36 36">
      <path fill="currentColor" d="M18 2a16 16 0 1 0 16 16A16 16 0 0 0 18 2m0 30a14 14 0 1 1 14-14 14 14 0 0 1-14 14" />
      <path fill="currentColor" d="M28 12.1a1 1 0 0 0-1.41 0l-11.1 11.05-6-6A1 1 0 0 0 8 18.53L15.49 26 28 13.52a1 1 0 0 0 0-1.42" />
      <path fill="none" d="M0 0h36v36H0z" />
    </svg>
  </button>

  <p class="resume-form__aware">
    @lang('Соглашаюсь на обработку')
    <a href="/blank" target="_blank">@lang('своих данных')</a>
  </p>
</form>
