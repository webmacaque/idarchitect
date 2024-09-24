@extends('layouts.admin')

@section("content")
    <div class="top">
        <span class="page-title">Список администраторов</span>
        <a href="{{route('admin-users-create-form')}}" class="button">Добавить</a>
    </div>
    <div class="users">
        @foreach($users as $user)
            <div class="user">
                <span class="user__name">{{$user->login}}</span>
                <div class="user-control">
                    <a href="{{route('admin-users-item-edit-form', $user->id)}}" class="button square white" title="Редактировать">
                        <img src="./assets/svg/edit.svg" />
                    </a>
                    @if(count($users)>1)
                    <a href="#" class="button square white open-modal" title="Удалить" data-remove="{{$user->id}}">
                        <img src="./assets/svg/remove.svg" />
                    </a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    <div id="overlay" class="overlay"></div>

    <div id="modal" class="modal" popover="manual">
        <span class="modal__title">Удаление администратора</span>
        <div class="modal__description">
            Вы действительно хотите удалить администратора?
        </div>
        <form class="modal-buttons" action="{{route('admin-users-delete')}}" method="post">
            @csrf
            <button class="button" type="submit">Да</button>
            <a class="button white" id="closeModalBtn">Нет</a>
        </form>
    </div>
@endsection

@section('menu_users', 'active')

