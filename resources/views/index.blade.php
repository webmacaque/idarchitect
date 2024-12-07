@extends('layouts.master')

@section('menu')
    <a href="#about" class="header-menu__link">О компании</a>
    <a href="#services" class="header-menu__link">Сервисы</a>
    <a href="#gallery" class="header-menu__link">Галерея проектов</a>
    <a href="#team" class="header-menu__link">Команда</a>
    <a href="#contacts" class="header-menu__link">Контакты</a>
@endsection

@section('content')
    @if($topProjects->isNotEmpty())
        <section class="swiper-container top-slider mobile">
            <div class="swiper-wrapper">
                @foreach($topProjects as $project)
                <div class="swiper-slide">
                    <div>
                        <img class="slide-image" src="{{$project->mainPhoto->path}}" alt="">
                        <div class="slide-content">
                            <span class="slide-content__title">{{$project->name}}</span>
                            <div class="slide-content__description">{{$project->description}}</div>
                            <div class="slide-content-bottom">
                                <a href="{{route('project', [$project->projectType->slug, $project->slug])}}" class="button--small button--gray">
                                    Смотреть
                                    <img
                                        class="button__icon"
                                        src="./assets/icons/button-arrow.svg"
                                        alt=""
                                    />
                                </a>
                                <div class="custom-pagination">
                                    @if($topProjects->count() > 1)
                                        <span class="custom-bullet" data-index="0"></span>
                                    @endif
                                    @for($i=1;$i<$topProjects->count();$i++)
                                        <span class="custom-bullet" data-index="{{$i}}"></span>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        <section class="swiper-container top-slider desktop">
      <div class="swiper-wrapper">
        @foreach($topProjects as $project)
        <div
              class="swiper-slide"
              data-background="{{$project->mainPhoto->path}}"
          >
              <div class="content">
                  <div class="slide-content">
                      <span class="slide-content__title">{{$project->name}}</span>
                      <div class="slide-content__description">{{$project->description}}</div>
                      <div class="slide-content-bottom">
                          <a href="{{route('project', [$project->projectType->slug, $project->slug])}}" class="button--small button--gray">
                              Смотреть
                              <img
                                  class="button__icon"
                                  src="./assets/icons/button-arrow.svg"
                                  alt=""
                              />
                          </a>
                          <div class="custom-pagination">
                              @if($topProjects->count() > 1)
                              <span class="custom-bullet" data-index="0"></span>
                              @endif
                              @for($i=1;$i<$topProjects->count();$i++)
                              <span class="custom-bullet" data-index="{{$i}}"></span>
                              @endfor
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        @endforeach
      </div>
    </section>
    @endif
    <section id="about" class="about">
      <div class="content">
        <h2 class="title">О компании</h2>
        <div class="about-text">
          <div>
            Наше архитектурное бюро осуществляет деятельность с 1999 года. За
            время работы мы спроектировали и реализовали множество проектов
            различного уровня сложности. Для нас не бывает неинтересных
            проектов.
          </div>
          <div>
            В нашем портфолио такие проекты как: ЖК «Волжская Ривьера», ЖК
            «Сердце Каспия», ЖК «Наследие», ЖК «Лотос Парк», главный офис
            «Лукойл», ЖК «Гагарин», ЖК «СЛОВА» реконструкция уникального
            развлекательного комплекса «ОКТЯБРЬ» и многие другие.
          </div>
          <div>
            У нас работают опытные специалисты, для которых нет нерешаемых
            задач.
              <br>
              <br>
              Наша миссия – СДЕЛАТЬ ГОРОД КРАСИВЫМ!
          </div>
        </div>
      </div>
    </section>
    <section id="services" class="services">
      <div class="content">
        <h2 class="title white services__title">Сервисы</h2>
        <div class="services-list">
            @include('service-list')
        </div>
        <div class="services-list mobile">
              <div class="services-list-element">
                  <div class="services-list-element__image">
                      <img src="./assets/icons/service1.svg" alt="service1" />
                  </div>
                  <span class="services-list-element__text">
              Разработка архитектурных проектов
            </span>
              </div>
              <div class="services-list-element">
                  <div class="services-list-element__image">
                      <img src="./assets/icons/service4.svg" alt="service4" />
                  </div>
                  <span class="services-list-element__text">
              Разработка проектов зоны охраны ОКН
            </span>
              </div>
              <div class="services-list-element">
                  <div class="services-list-element__image">
                      <img src="./assets/icons/service2.svg" alt="service1" />
                  </div>
                  <span class="services-list-element__text">
              Дизайн интерьеров
            </span>
              </div>

          </div>
      </div>
    </section>
    <section id="gallery">
      <div class="gallery">
        <div class="content gallery-title">
          <h2 class="title">Галерея проектов</h2>
        </div>
      </div>
        @foreach($projectTypes as $type)
        <div class="gallery-content content">
            <div class="gallery-slider">
                <span class="gallery-slider-top__title"> {{$type->name}} </span>
                <div class="swiper-container-gallery1">
                    <div class="swiper-wrapper">
                        @foreach($type->mainProjects as $project)
                        <div class="swiper-slide">
                            <a href="{{route('project', [$type->slug, $project->slug])}}" class="gallery-slider-container">
                                <img
                                    class="gallery-slider-image"
                                    src="{{ $project->mainPhoto->path }}"
                                    alt="slide"
                                />
                                <span class="gallery-slider__name">{{$project->name}}</span>
                                <span class="gallery-slider__year"
                                >{{$project->short_description}} / {{$project->year}}</span
                                >
                            </a>
                        </div>
                        @endforeach


                    </div>
                    <button
                        class="gallery-slider1-prev gallery-slider-nav gallery-slider-prev button--black button--big"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                            <path d="M8 15L2 8L8 1" stroke="white" stroke-width="2"/>
                        </svg>
                    </button>
                    <button
                        class="gallery-slider1-next gallery-slider-nav gallery-slider-next button--black button--big"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="9" height="16" viewBox="0 0 9 16" fill="none">
                            <path d="M8 15L2 8L8 1" stroke="white" stroke-width="2"/>
                        </svg>
                    </button>
                </div>
                <div class="gallery-slider-bottom">
            <span class="gallery-slider-bottom__title">
              {{$type->name}}
            </span>
                    <div
                        class="gallery-slider1-pagination gallery-slider-pagination"
                    ></div>
                    <a href="{{route('project-type', $type->slug)}}" class="button--big button--black">Посмотреть все</a>
                </div>
            </div>
        </div>
        @endforeach
    </section>
    <section id="team" class="team">
      <div class="content">
          <h2 class="title white team__title">Команда</h2>
          <h3 class="team__subtitle">Менеджмент и ключевые сотрудники</h3>
          <div class="team-people">
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team11.natalya.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Наталья</span>
                  <span class="team-people-element__who">Руководитель</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team12.anton.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Антон</span>
                  <span class="team-people-element__who">Коммерческий директор</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team13.pavel.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Павел</span>
                  <span class="team-people-element__who">Инженер</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team14.pavel.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Павел</span>
                  <span class="team-people-element__who">ГИП</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team15.anver.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Анвер</span>
                  <span class="team-people-element__who">Главный дизайнер</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team21.radmir.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Радмир</span>
                  <span class="team-people-element__who">Архитектор</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team22.sergey.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Сергей</span>
                  <span class="team-people-element__who">Архитектор</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team23.maria.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Мария</span>
                  <span class="team-people-element__who">Архитектор</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team24.yulia.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Юлия</span>
                  <span class="team-people-element__who">Архитектор</span>
              </div>
              <div class="team-people-element">
                  <img
                      class="team-people-element__image"
                      src="./assets/images/team/team25.roman.png"
                      alt="team"
                  />
                  <span class="team-people-element__name">Роман</span>
                  <span class="team-people-element__who">Архитектор</span>
              </div>
          </div>
      </div>
    </section>
    <section class="map" id="map"></section>

@endsection

@section('footerStyles')
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
@endsection
