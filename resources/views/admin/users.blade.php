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
    @include('admin.delete-modal', [
    'title'=>'Удаление администратора',
    'description' => 'Вы действительно хотите удалить администратора?',
    'action' => route('admin-users-delete')
    ])
@endsection

@section('menu_users', 'active')

