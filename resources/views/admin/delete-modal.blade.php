<div id="overlay" class="overlay"></div>

<div id="modal" class="modal" popover="manual">
    <span class="modal__title">{{$title}}</span>
    <div class="modal__description">
        {{$description}}
    </div>
    <form class="modal-buttons" action="{{$action}}" method="post">
        @csrf
        <button class="button" type="submit">Да</button>
        <a class="button white" id="closeModalBtn">Нет</a>
    </form>
</div>
