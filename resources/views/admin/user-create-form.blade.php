@extends('layouts.admin')

@section("content")
    <div class="block">
        <span class="block-title page-title">Создать администратора</span>
        <form class="user-inputs" method="post">
            @csrf
            <input
                type="text"
                class="input"
                name="login"
                id="user-name"
                value="{{old('login')}}"
                required
                placeholder="Введите логин администратора"
            /> @error('login') логин {{old('login')}} уже существует @enderror
            <input
                type="password"
                class="input"
                name="password"
                id="user-password"
                required
                placeholder="Введите пароль администратора"
            />
            <div class="user-inputs-buttons">
                <button class="button" type="submit">Создать</button>
                <a href="{{route('admin-users')}}" class="button white">Отмена</a>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <div id="overlay" class="overlay"></div>

    <div id="modal" class="modal" popover="manual">
        <span class="modal__title">Удаление администратора</span>
        <div class="modal__description">
            Вы действительно хотите удалить администратора?
        </div>
        <form class="modal-buttons">
            <button class="button">Да</button>
            <button class="button white" id="closeModalBtn">Нет</button>
        </form>
    </div>
@endsection

@section('menu_users', 'active')

