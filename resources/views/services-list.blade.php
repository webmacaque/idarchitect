@if($type=='desktop')
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
              Дизайн  интерьеров
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
@elseif($type=='mobile')
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
            <img src="./assets/icons/service5.svg" alt="service4" />
        </div>
        <span class="services-list-element__text">
              Разработка ПД по реставрации и приспособлению ОКН
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
@endif
