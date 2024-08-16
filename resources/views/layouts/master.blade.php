<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
@section('headerStyles')
    <link rel="stylesheet" href="/styles/normalize.css" />
    <link rel="stylesheet" href="/styles/fonts.css" />
    <link rel="stylesheet" href="/styles/style.css" />
@show
    <title>ID Architects</title>
</head>
<body>
<div class="header-mobile">
    <img class="header-mobile__logo" src="/assets/svg/logo.svg" alt="logo" />
    <img
        class="header-mobile__logo--white"
        src="/assets/svg/logo-white.svg"
        alt="logo"
    />
    <div class="header-burger">
        <img
            class="header-mobile__menu"
            src="/assets/icons/mobile-menu.svg"
            alt="menu"
        />
        <img
            class="header-mobile__menu--close"
            src="/assets/icons/mobile-menu-close.svg"
            alt="menu"
        />
    </div>
</div>
<div class="header-mobile-menu">
    @yield('menu')
</div>
<header class="header">
    <div class="content header-content">
        <a href="/">
            <img
                class="header-logo"
                src="/assets/svg/logo.svg"
                alt="id architect"
            />
        </a>
        <nav class="header-menu">
            @yield('menu')
        </nav>
        <img
            class="header-menu__burger"
            src="/assets/icons/mobile-menu.svg"
            alt="menu"
        />
    </div>
</header>
    @yield('content')
<footer id="contacts">
    <div class="content footer-content">
        <a class="footer-logo" href="/">
            <img src="/assets/svg/logo.svg" alt="id architect" />
        </a>
        <div class="footer-text">
            <div class="footer-text__address">
                414000, Россия, Астрахань, ул. Свердлова, 45
            </div>
            <div class="footer-text__email">
                E-mail:<br />
                <a href="mailto:idarchitects@mail.ru">idarchitects@mail.ru</a>
            </div>
            <div class="footer-text__site">
                Официальный сайт<br />компании ID Architects.
            </div>
            <div class="footer-text__phone">
                Тел./факс:<br />
                <a href="tel:+78512523333">+7 (8512) 52-33-33</a><br />
                <a href="tel:+78512524444">+7 (8512) 52-44-44</a>
            </div>
            <div class="footer-text__wa">
                <a class="footer-text-middle" href="https://wa.me/79272823222">
                    +7 (927) 282-33-22
                    <img src="/assets/svg/wa.svg" alt="wa" />
                </a>
            </div>
            <div class="footer-text__copy">
                Copyright 2016 ID Architects.<br />Все права защищены.
            </div>
        </div>
        <div class="footer-socials">
            <a target="_blank" href="https://vk.com/id_architects">
                <img src="/assets/svg/vk.svg" alt="vk" />
            </a>
            <a
                target="_blank"
                href="https://www.instagram.com/idarchitects?igsh=ZnVrcnprYnlwNXp5"
            >
                <img src="/assets/svg/inst.svg" alt="instagram" />
            </a>
        </div>
    </div>
</footer>

@yield('footerStyles')
@section('footerScripts')
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyAHFeM7mawK3A9rRcR_F1iaeBQIJBzeFDY"></script>
    <script src="/assets/scripts/index.js"></script>
@show
</body>
</html>

