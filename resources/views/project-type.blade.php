@extends('layouts.master')

@section('menu')
    <a href="/#about" class="header-menu__link">О компании</a>
    <a href="/#services" class="header-menu__link">Услуги</a>
    <a href="/#gallery" class="header-menu__link active">Галерея проектов</a>
    <a href="/#team" class="header-menu__link">Команда</a>
    <a href="/#contacts" class="header-menu__link">Контакты</a>
@endsection

@section('content')
    <div class="page">
      <div class="content">
        <div class="page-top">
          <a href="#" class="page-top-back">
            <img src="/assets/icons/back.svg" alt="back" />
            Назад
          </a>
          <div class="page-top-filter">
            <a href="#" class="page-top-filter__link active">Архитектура</a>
            <span>/</span>
            <a href="#" class="page-top-filter__link">Интерьеры</a>
          </div>
        </div>
        <div class="projects">
          <a href="#" class="projects-element">
            <img
              class="projects-element__img"
              src="/assets/images/top-slide-2.jpg"
              alt="image"
            />
            <div class="projects-element-bottom">
              <span class="projects-element-bottom__name">
                "Волжская Ривьера"
              </span>
              <span class="projects-element-bottom__year">
                Жилой комплекс / 2014
              </span>
            </div>
          </a>
          <a href="#" class="projects-element">
            <img
              class="projects-element__img"
              src="/assets/images/top-slide-2.jpg"
              alt="image"
            />
            <div class="projects-element-bottom">
              <span class="projects-element-bottom__name">
                "Волжская Ривьера"
              </span>
              <span class="projects-element-bottom__year">
                Жилой комплекс / 2014
              </span>
            </div>
          </a>
          <a href="#" class="projects-element">
            <img
              class="projects-element__img"
              src="/assets/images/top-slide-2.jpg"
              alt="image"
            />
            <div class="projects-element-bottom">
              <span class="projects-element-bottom__name">
                "Волжская Ривьера"
              </span>
              <span class="projects-element-bottom__year">
                Жилой комплекс / 2014
              </span>
            </div>
          </a>
          <a href="#" class="projects-element">
            <img
              class="projects-element__img"
              src="/assets/images/top-slide-2.jpg"
              alt="image"
            />
            <div class="projects-element-bottom">
              <span class="projects-element-bottom__name">
                "Волжская Ривьера"
              </span>
              <span class="projects-element-bottom__year">
                Жилой комплекс / 2014
              </span>
            </div>
          </a>
        </div>
        <div class="pagination">
          <a href="#" class="pagination-element active">1</a>
          <a href="#" class="pagination-element">2</a>
          <a href="#" class="pagination-element">3</a>
          <a href="#" class="pagination-element">...</a>
          <a href="#" class="pagination-element">10</a>
        </div>
      </div>
    </div>
@endsection
