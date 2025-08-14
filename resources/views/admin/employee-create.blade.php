@extends('layouts.admin')

@section('menu_employees', 'active')

@section('content')
    <form class="block" action="{{ route('admin-employees-store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <span class="block-title page-title">Добавление сотрудника</span>
        <div class="employee-form">
            <div class="upload-container" id="uploadContainer">
                <input type="file" id="fileInput" name="photo" class="hidden" accept="image/*" required>
                <img class="upload-container-img" id="previewImage" alt="Preview" style="display: none;">
            </div>
            <div class="user-inputs">
                <input
                    type="text"
                    class="input @error('name') is-invalid @enderror"
                    name="name"
                    id="user-name"
                    required
                    placeholder="Имя"
                    value="{{ old('name') }}"
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
                    value="{{ old('position') }}"
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
            <button type="submit" class="button">Добавить</button>
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

        uploadContainer.addEventListener('click', () => fileInput.click());

        fileInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block';
                    uploadContainer.style.background = 'none';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
