<div class="cookie-banner" id="cookie-banner" hidden>
    <div class="cookie-banner__inner">
        <p class="cookie-banner__text">
            Используя сайт, вы соглашаетесь с
            <a href="{{ route('cookie-policy') }}" class="cookie-banner__link" data-cookie-open>использованием cookie</a>
            и
            <a href="{{ route('privacy-policy') }}" class="cookie-banner__link" data-privacy-open>политикой конфиденциальности</a>.
        </p>
        <button type="button" class="button--small button--black cookie-banner__accept" data-cookie-accept>
            ПРИНЯТЬ
        </button>
    </div>
</div>

<div class="cookie-modal" id="cookie-modal" hidden>
    <div class="cookie-modal__backdrop" data-modal-close></div>
    <div
        class="cookie-modal__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="cookie-modal-title"
    >
        <div class="cookie-modal__header">
            <h2 class="cookie-modal__title" id="cookie-modal-title">Политика использования файлов cookie</h2>
            <button type="button" class="cookie-modal__close" data-modal-close aria-label="Закрыть">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="cookie-modal__body">
            @include('partials.policy-cookie')
        </div>
    </div>
</div>

<div class="cookie-modal" id="privacy-modal" hidden>
    <div class="cookie-modal__backdrop" data-modal-close></div>
    <div
        class="cookie-modal__dialog"
        role="dialog"
        aria-modal="true"
        aria-labelledby="privacy-modal-title"
    >
        <div class="cookie-modal__header">
            <h2 class="cookie-modal__title" id="privacy-modal-title">Политика в отношении обработки персональных данных</h2>
            <button type="button" class="cookie-modal__close" data-modal-close aria-label="Закрыть">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="cookie-modal__body">
            @include('partials.policy-privacy')
        </div>
    </div>
</div>
