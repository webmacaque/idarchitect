@extends('layouts.admin')

@section('menu_users', 'active')

@section('content')
    <div class="top">
        <span class="page-title">Список администраторов</span>
        <a href="{{ route('admin-users-create') }}" class="button">Добавить</a>
    </div>
    <div class="users">
        @foreach($users as $user)
            <div class="user">
                <span class="user__name">{{ $user->login }}</span>
                <div class="user-control">
                    <a href="{{ route('admin-users-edit', $user->id) }}" class="button square white" title="Редактировать">
                        <img src="/admin/assets/svg/edit.svg" />
                    </a>
                    <a href="#" class="button square white open-modal" data-id="{{ $user->id }}" title="Удалить">
                        <img src="/admin/assets/svg/remove.svg" />
                    </a>
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
        <form action="{{ route('admin-users-delete') }}" method="POST" class="modal-buttons">
            @csrf
            @method('DELETE')
            <input type="hidden" name="user_id" id="deleteUserId" value="">
            <button type="submit" class="button">Да</button>
            <button type="button" class="button white" id="closeModalBtn">Нет</button>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.open-modal');
            const deleteUserIdInput = document.getElementById('deleteUserId');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const userId = this.getAttribute('data-id');
                    deleteUserIdInput.value = userId;
                });
            });
        });
    </script>
@endsection

