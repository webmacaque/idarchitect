@extends('layouts.admin')

@section('content')
    <form class="block" method="post" action="{{ route('admin-panoramas-store-tour') }}" enctype="multipart/form-data">
        @csrf
        <span class="block-title page-title">Добавление тура</span>
        
        <div class="panorama-form-field">
            <input
                type="text"
                name="name"
                id="name"
                class="input"
                required
                placeholder="Название тура"
            />
        </div>

        <div class="file-upload-component">
            <div class="file-input-container">
                <label class="custom-file-upload">
                    <input type="file" class="file-input" multiple name="images[]" accept="image/*" required />
                    Нажмите на поле чтобы загрузить фото к проекту
                </label>
            </div>
            <span class="panorama-form__hint panorama-form__hint--warning">Внимание! Можно добавить только одну картинку!</span>
            <ul class="file-list"></ul>
        </div>

        <div class="panorama-form-buttons">
            <button class="button" type="submit" id="submit-btn" disabled>Создать</button>
            <a href="{{ route('admin-panoramas') }}" class="button white">Отмена</a>
        </div>
    </form>
@endsection

@section('scripts')
    @parent
    <script>
        const fileInput = document.querySelector('.file-input');
        const fileList = document.querySelector('.file-list');
        const submitBtn = document.getElementById('submit-btn');
        let selectedFiles = [];

        fileInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            selectedFiles = [...selectedFiles, ...newFiles];
            updateFileList();
            updateSubmitButton();
        });

        function updateFileList() {
            fileList.innerHTML = '';
            selectedFiles.forEach((file, index) => {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span class="file-list-element__check">✓</span>
                    <span class="file-name">${file.name}</span>
                    <span class="file-list-element__delete" data-index="${index}">×</span>
                `;
                fileList.appendChild(li);
            });

            // Обновляем input files
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;

            // Добавляем обработчики удаления
            document.querySelectorAll('.file-list-element__delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    selectedFiles.splice(index, 1);
                    updateFileList();
                    updateSubmitButton();
                });
            });
        }

        function updateSubmitButton() {
            const nameInput = document.getElementById('name');
            submitBtn.disabled = selectedFiles.length === 0 || nameInput.value.trim() === '';
        }

        document.getElementById('name').addEventListener('input', updateSubmitButton);
    </script>
@endsection

@section('menu_panoramas', 'active')
