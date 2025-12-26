@extends('layouts.master')

@section('menu')
    <a href="/#about" class="header-menu__link">О компании</a>
    <a href="/#services" class="header-menu__link">Сервисы</a>
    <a href="/#gallery" class="header-menu__link active">Галерея проектов</a>
    <a href="/#team" class="header-menu__link">Команда</a>
    <a href="/#contacts" class="header-menu__link">Контакты</a>
@endsection

@section('content')
    <div class="page">
        <div class="content">
            <div class="page-top">
                <a href="{{ url()->previous() }}" class="page-top-back">
                    <img src="/assets/icons/back.svg" alt="back" />
                    Назад
                </a>
            </div>
            
            <span class="project-title">Тур "{{ $panorama->name }}"</span>
            
            <div id="panorama"></div>
            <div class="panorama-list">
                @foreach($panorama->images as $image)
                    <img
                        class="panorama-list__element"
                        data-image="{{ $image->path }}"
                        src="{{ $image->path }}"
                        alt="panorama"
                    />
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('headerStyles')
    @parent
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"
    />
@endsection

@section('footerScripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @if($panorama->images->isNotEmpty())
    <script>
        const img = document.querySelectorAll(".panorama-list__element");
        img.forEach((element) => {
            element.addEventListener("click", () => {
                img.forEach((element) => {
                    element.classList.remove("active");
                });
                element.classList.add('active');

                pannellum.viewer("panorama", {
                    type: "equirectangular",
                    panorama: element.dataset.image,
                    autoLoad: true,
                });
            });
        });

        if (img.length > 0) {
            img[0].classList.add('active');

            pannellum.viewer("panorama", {
                type: "equirectangular",
                panorama: img[0].src,
                autoLoad: true,
            });
        }
    </script>
    @endif
@endsection
