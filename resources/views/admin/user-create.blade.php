@extends('layouts.admin')

@section('menu_users', 'active')

@section('content')
    <div class="block">
        <span class="block-title page-title">Добавление администратора</span>
        <form class="user-inputs" action="{{ route('admin-users-store') }}" method="POST">
            @csrf
            <input
                type="text"
                class="input @error('login') is-invalid @enderror"
                name="login"
                id="user-login"
                required
                placeholder="Введите логин администратора"
                value="{{ old('login') }}"
            />
            @error('login')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <input
                type="password"
                class="input @error('password') is-invalid @enderror"
                name="password"
                id="user-password"
                required
                placeholder="Введите пароль администратора"
            />
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="user-inputs-buttons">
                <button type="submit" class="button">Добавить</button>
                <a href="{{ route('admin-users') }}" class="button white">Отмена</a>
            </div>
        </form>
    </div>
@endsection
