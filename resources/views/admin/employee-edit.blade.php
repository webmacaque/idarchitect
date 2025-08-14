@extends('layouts.admin')

@section('menu_employees', 'active')

@section('content')
    <form class="block" action="{{ route('admin-employees-update', $employee->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <span class="block-title page-title">Редактирование сотрудника</span>
        <div class="employee-form">
            <div class="upload-container" id="uploadContainer">
                <input type="file" id="fileInput" name="photo" class="hidden" accept="image/*">
                <input type="hidden" name="keep_existing_photo" id="keepExistingPhoto" value="1">
                <img id="previewImage" class="upload-container-edit-img" src="data:image/png;base64,{{ $employee->photo_path }}" alt="{{ $employee->name }}">
                <span id="removeBtn" class="upload-container-remove" style="{{ $employee->photo_path ? 'display: block;' : 'display: none;' }}">
                    <img src="/admin/assets/svg/upload-remove.svg"/>
                </span>
            </div>
            <div class="user-inputs">
                <input
                    type="text"
                    class="input @error('name') is-invalid @enderror"
                    name="name"
                    id="user-name"
                    required
                    placeholder="Имя"
                    value="{{ old('name', $employee->name) }}"
                />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <input
                    type="text"
                    class="input @error('position') is-invalid @enderror"
                    name="position"
                    id="user-position"
                    required
                    placeholder="Должность"
                    value="{{ old('position', $employee->position) }}"
                />
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <span class="employee-info-photo">Размер для фото сотрудника должен быть 140х140px.</span>
        @error('photo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <div class="user-inputs-buttons">
            <button type="submit" class="button">Сохранить</button>
            <a href="{{ route('admin-employees') }}" class="button white">Отмена</a>
        </div>
    </form>
@endsection

@section('scripts')
    @parent
    <script>
        const uploadContainer = document.getElementById('uploadContainer');
        const fileInput = document.getElementById('fileInput');
        const previewImage = document.getElementById('previewImage');
        const removeBtn = document.getElementById('removeBtn');
        const keepExistingPhoto = document.getElementById('keepExistingPhoto');

        uploadContainer.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    removeBtn.style.display = 'block';
                    keepExistingPhoto.value = '1';
                };
                reader.readAsDataURL(file);
            }
        });

        removeBtn.addEventListener('click', (event) => {
            event.stopPropagation();
            previewImage.src = '';
            previewImage.style.display = 'none';
            removeBtn.style.display = 'none';
            fileInput.value = '';
            keepExistingPhoto.value = '0';
        });
    </script>
@endsection
