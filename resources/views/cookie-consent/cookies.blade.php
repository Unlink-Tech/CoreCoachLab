<aside id="cookies-policy" class="cookies cookies--no-js artify-cookies" data-text="{{ json_encode(__('cookieConsent::cookies.details')) }}">
    <div class="artify-cookies__overlay"></div>
    <div class="artify-cookies__card">
        <!-- Header -->
        <div class="artify-cookies__header">
            <div class="artify-cookies__icon"><i class="fas fa-cookie"></i></div>
            <h2 class="artify-cookies__title">@lang('cookieConsent::cookies.title')</h2>
            <button class="artify-cookies__close" aria-label="Close cookie consent" onclick="document.getElementById('cookies-policy').remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Content -->
        <div class="artify-cookies__content">
            <p class="artify-cookies__intro">@lang('cookieConsent::cookies.intro')</p>
            @if($policy)
                <p class="artify-cookies__policy-link">
                    @lang('cookieConsent::cookies.link', ['url' => $policy])
                </p>
            @endif
        </div>

        <!-- Actions -->
        <div class="artify-cookies__actions">
            @cookieconsentbutton(action: 'accept.essentials', label: __('cookieConsent::cookies.essentials'), attributes: ['class' => 'artify-cookies__btn artify-cookies__btn--secondary'])
            @cookieconsentbutton(action: 'accept.all', label: __('cookieConsent::cookies.all'), attributes: ['class' => 'artify-cookies__btn artify-cookies__btn--primary'])
        </div>

        <!-- Customize toggle -->
        <button class="artify-cookies__customize-toggle" onclick="document.getElementById('cookies-policy-customize').classList.toggle('artify-cookies__expand--open')">
            <span>@lang('cookieConsent::cookies.customize')</span>
            <i class="fas fa-chevron-down"></i>
        </button>

        <!-- Customize section -->
        <div class="artify-cookies__expand" id="cookies-policy-customize">
            <form action="{{ route('cookieconsent.accept.configuration') }}" method="post" class="artify-cookies__customize">
                @csrf
                <div class="artify-cookies__sections">
                    @foreach($cookies->getCategories() as $category)
                    <div class="artify-cookies__section">
                        <label for="cookies-policy-check-{{ $category->key() }}" class="artify-cookies__category">
                            @if ($category->key() === 'essentials')
                                <input type="hidden" name="categories[]" value="{{ $category->key() }}" />
                                <input type="checkbox" name="categories[]" value="{{ $category->key() }}" id="cookies-policy-check-{{ $category->key() }}" checked="checked" disabled="disabled" />
                            @else
                                <input type="checkbox" name="categories[]" value="{{ $category->key() }}" id="cookies-policy-check-{{ $category->key() }}" />
                            @endif
                            <span class="artify-cookies__checkbox"></span>
                            <strong class="artify-cookies__cat-title">{{ $category->title }}</strong>
                        </label>
                        @if($category->description)
                            <p class="artify-cookies__cat-desc">{{ $category->description }}</p>
                        @endif

                        @if($category->getCookies()->count() > 0)
                        <button type="button" class="artify-cookies__more-toggle" onclick="this.parentElement.querySelector('.artify-cookies__details').classList.toggle('artify-cookies__details--open')">
                            @lang('cookieConsent::cookies.details.more')
                            <i class="fas fa-plus"></i>
                        </button>
                        <div class="artify-cookies__details">
                            <ul class="artify-cookies__cookies-list">
                                @foreach($category->getCookies() as $cookie)
                                <li class="artify-cookies__cookie-item">
                                    <strong class="artify-cookies__cookie-name">{{ $cookie->name }}</strong>
                                    <span class="artify-cookies__cookie-duration">{{ \Carbon\CarbonInterval::minutes($cookie->duration)->cascade() }}</span>
                                    @if($cookie->description)
                                        <p class="artify-cookies__cookie-desc">{{ $cookie->description }}</p>
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>

                <div class="artify-cookies__footer">
                    <button type="submit" class="artify-cookies__save">@lang('cookieConsent::cookies.save')</button>
                </div>
            </form>
        </div>
    </div>
</aside>

<script data-cookie-consent>
    {!! file_get_contents(LCC_ROOT . '/dist/script.js') !!}
</script>
<!-- vendor styles removed; all styling provided by app.css -->
