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
                <a href="{{ $backUrl }}" class="page-top-back">
                    <img src="/assets/icons/back.svg" alt="back" />
                    Назад
                </a>
                <div class="page-top-info">
                    <span class="page-top-info__name">"{{$project->name}}"</span>
                    <span class="page-top-info__year">{{$project->short_description}} / {{$project->year}}</span>
                </div>
            </div>
            @unless(empty($project->description))
            <div class="project-description">{{$project->description}}</div>
            @endunless
            @foreach($photoTypes as $type)
                @if($photos[$type->slug]->isNotEmpty())
                    <span class="project-title">{{$type->name}}</span>
                    @unless($type->slug==='360')
                        <div class="project-photos">
                            @foreach($photos[$type->slug] as $i=>$photo)
                                <a
                                    href="{{$photo->path}}"
                                    data-fancybox="gallery"
                                    data-caption="{{$type->name}} #{{$i+1}}"
                                >
                                    <img src="{{$photo->path}}" />
                                </a>
                            @endforeach
                        </div>
                    @else
                        <div id="panorama"></div>
                        <div class="panorama-list">
                            @foreach($photos[$type->slug] as $photo)
                                <img
                                    class="panorama-list__element"
                                    data-image="{{$photo->path}}"
                                    src="{{$photo->path}}"
                                    alt="panorama"
                                />
                            @endforeach
                        </div>
                    @endunless
                @endif
            @endforeach
        </div>
    </div>
@endsection

@section('headerStyles')
    @parent
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"
    />
@endsection

@section('footerScripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
    @if($photos[360]->isNotEmpty())
    <script>
        const img = document.querySelectorAll(".panorama-list__element");
        img.forEach((element) => {
            element.addEventListener("click", () => {
                pannellum.viewer("panorama", {
                    type: "equirectangular",
                    panorama: element.dataset.image,
                    autoLoad: true,
                });
            });
        });

        if (img.length > 0) {
            pannellum.viewer("panorama", {
                type: "equirectangular",
                panorama: img[0].src,
                autoLoad: true,
            });
        }
    </script>
    @endif
@endsection
