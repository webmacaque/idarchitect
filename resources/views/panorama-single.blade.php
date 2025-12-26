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
            
            <div id="panorama"></div>
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
        pannellum.viewer("panorama", {
            type: "equirectangular",
            panorama: "{{ $panorama->images->first()->path }}",
            autoLoad: true,
        });
    </script>
    @endif
@endsection
