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
    <section class="swiper-container top-slider">
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
          </div>
        </div>
      </div>
    </section>
    <section id="services" class="services">
      <div class="content">
        <h2 class="title white services__title">Сервисы</h2>
        <div class="services-list">
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
              <img src="./assets/icons/service2.svg" alt="service1" />
            </div>
            <span class="services-list-element__text">
              Дизайн жилых и<br />общественных интерьеров
            </span>
          </div>
          <div class="services-list-element">
            <div class="services-list-element__image">
              <img src="./assets/icons/service3.svg" alt="service3" />
            </div>
            <span class="services-list-element__text">
              Разработка проектной документации
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
              <img src="./assets/icons/service5.svg" alt="service5" />
            </div>
            <span class="services-list-element__text">
              Разработка ПД по реставрации и приспособлению ОКН
            </span>
          </div>
          <div class="services-list-element">
            <div class="services-list-element__image">
              <img src="./assets/icons/service6.svg" alt="service6" />
            </div>
            <span class="services-list-element__text">
              Юридическое<br />сопровождение
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
                        <svg
                            width="6"
                            height="14"
                            viewBox="0 0 6 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M5 1L1 7L5 13" stroke="white" />
                        </svg>
                    </button>
                    <button
                        class="gallery-slider1-next gallery-slider-nav gallery-slider-next button--black button--big"
                    >
                        <svg
                            width="6"
                            height="14"
                            viewBox="0 0 6 14"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path d="M5 1L1 7L5 13" stroke="white" />
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
        <h2 class="title white team__title">Наша команда</h2>
        <div class="team-people">
          <div class="team-people-element">
            <img
              class="team-people-element__image"
              src="./assets/images/team1.png"
              alt="team"
            />
            <span class="team-people-element__name">Иван</span>
            <span class="team-people-element__who">Руководитель</span>
          </div>
          <div class="team-people-element">
            <img
              class="team-people-element__image"
              src="./assets/images/team2.png"
              alt="team"
            />
            <span class="team-people-element__name">Алина</span>
            <span class="team-people-element__who">Менеджер</span>
          </div>
          <div class="team-people-element">
            <img
              class="team-people-element__image"
              src="./assets/images/team3.png"
              alt="team"
            />
            <span class="team-people-element__name">Игнат</span>
            <span class="team-people-element__who">Архитектор</span>
          </div>
          <div class="team-people-element">
            <img
              class="team-people-element__image"
              src="./assets/images/team4.jpg"
              alt="team"
            />
            <span class="team-people-element__name">Виктор</span>
            <span class="team-people-element__who">Дизайнер</span>
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
