@extends('layouts.admin')

@section('menu_employees', 'active')

@section('content')
    <div class="top">
        <span class="page-title">Список сотрудников</span>
        <a href="{{ route('admin-employees-create') }}" class="button">Добавить</a>
    </div>
    <div class="employees">
        @foreach($employees as $index => $employee)
            <div class="employee">
                <img class="employee__img" src="data:image/png;base64,{{ $employee->photo_path }}" alt="{{ $employee->name }}">
                <div class="employee-content">
                    <div class="employee-content-left">
                        <span class="employee-content__name">{{ $employee->name }}</span>
                        <span class="employee-content__job">{{ $employee->position }}</span>
                    </div>
                    <div class="employee-content-right">
                        <div class="user-control">
                            <form action="{{ route('admin-employees-reorder', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="direction" value="up">
                                <button type="submit" class="button square white" {{ $index === 0 ? 'disabled' : '' }} title="Наверх">
                                    <img src="/admin/assets/svg/top.svg" />
                                </button>
                            </form>
                            <form action="{{ route('admin-employees-reorder', $employee->id) }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="direction" value="down">
                                <button type="submit" class="button square white" {{ $index === count($employees) - 1 ? 'disabled' : '' }} title="Вниз">
                                    <img src="/admin/assets/svg/bottom.svg" />
                                </button>
                            </form>
                            <a href="{{ route('admin-employees-edit', $employee->id) }}" class="button square white" title="Редактировать">
                                <img src="/admin/assets/svg/edit.svg" />
                            </a>
                            <a href="#" class="button square white open-modal" data-id="{{ $employee->id }}" title="Удалить">
                                <img src="/admin/assets/svg/remove.svg" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('footer')
    <div id="overlay" class="overlay"></div>

    <div id="modal" class="modal" popover="manual">
        <span class="modal__title">Удаление сотрудника</span>
        <div class="modal__description">
            Вы действительно хотите удалить сотрудника?
        </div>
        <form action="{{ route('admin-employees-delete') }}" method="POST" class="modal-buttons">
            @csrf
            @method('DELETE')
            <input type="hidden" name="employee_id" id="deleteEmployeeId" value="">
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
            const deleteEmployeeIdInput = document.getElementById('deleteEmployeeId');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const employeeId = this.getAttribute('data-id');
                    deleteEmployeeIdInput.value = employeeId;
                });
            });
        });
    </script>
@endsection
