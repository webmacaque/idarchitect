@extends('layouts.admin')

@section("content")
    <div class="block">
        <span class="block-title page-title">Изменить администратора</span>
        <form class="user-inputs" method="post">
            @csrf
            <input
                type="text"
                class="input"
                name="login"
                id="user-name"
                value="{{$user->login}}"
                required
                disabled
                placeholder="Введите логин администратора"
            />
            <input
                type="password"
                class="input"
                name="password"
                id="user-password"
                required
                placeholder="Введите пароль администратора"
            />
            <div class="user-inputs-buttons">
                <button class="button">Изменить</button>
                <a href="{{route('admin-users')}}" class="button white">Отмена</a>
            </div>
        </form>
    </div>
@endsection

@section('menu_users', 'active')

