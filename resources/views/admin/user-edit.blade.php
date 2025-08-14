@extends('layouts.admin')

@section('menu_users', 'active')

@section('content')
    <div class="block">
        <span class="block-title page-title">Редактирование администратора</span>
        <form class="user-inputs" action="{{ route('admin-users-update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <input
                type="text"
                class="input @error('login') is-invalid @enderror"
                name="login"
                id="user-login"
                required
                placeholder="Введите логин администратора"
                value="{{ old('login', $user->login) }}"
            />
            @error('login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <input
                type="password"
                class="input @error('password') is-invalid @enderror"
                name="password"
                id="user-password"
                placeholder="Введите новый пароль администратора (оставьте пустым, чтобы не менять)"
            />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="user-inputs-buttons">
                <button type="submit" class="button">Сохранить</button>
                <a href="{{ route('admin-users') }}" class="button white">Отмена</a>
            </div>
        </form>
    </div>
@endsection
