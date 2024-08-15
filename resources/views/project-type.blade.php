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
                <a href="{{route('index')}}" class="page-top-back">
                    <img src="/assets/icons/back.svg" alt="back" />
                    Назад
                </a>
                <div class="page-top-filter">
                    @foreach($projectTypes as $projectType)
                    <a href="{{route('project-type', $projectType->slug)}}" class="page-top-filter__link
                    {{$projectType->id===$currentType->id? 'active':''}}
                    ">{{$projectType->short_name}}</a>
                        @unless($loop->last)
                            <span>/</span>
                        @endunless
                    @endforeach
                </div>
            </div>
            <div class="projects">
                @foreach($currentProjects as $project)
                <a href="{{route('project', [$currentType->slug, $project->slug])}}" class="projects-element">
                    <img
                        class="projects-element__img"
                        src="{{ $project->mainPhoto->path }}"
                        alt="image"
                    />
                    <div class="projects-element-bottom">
              <span class="projects-element-bottom__name">
                {{$project->name}}
              </span>
                        <span class="projects-element-bottom__year">
                {{$project->short_description}} / {{$project->year}}
              </span>
                    </div>
                </a>
                @endforeach
            </div>
            {{$currentProjects->links('pagination.default', ['onEachSide'=>2])}}
        </div>
    </div>
@endsection
