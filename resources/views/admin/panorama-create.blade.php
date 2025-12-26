@extends('layouts.admin')

@section('content')
    <form class="block" method="post" action="{{ route('admin-panoramas-store-panorama') }}" enctype="multipart/form-data">
        @csrf
        <span class="block-title page-title">Добавление панорамы</span>

        <div class="file-upload-component">
            <div class="file-input-container">
                <label class="custom-file-upload">
                    <input type="file" class="file-input" name="images[]" accept="image/*" required />
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
        let selectedFile = null;

        fileInput.addEventListener('change', function(e) {
            if (e.target.files.length > 0) {
                selectedFile = e.target.files[0];
                updateFileList();
                updateSubmitButton();
            }
        });

        function updateFileList() {
            fileList.innerHTML = '';
            if (selectedFile) {
                const li = document.createElement('li');
                li.innerHTML = `
                    <span class="file-list-element__check">✓</span>
                    <span class="file-name">${selectedFile.name}</span>
                    <span class="file-list-element__delete">×</span>
                `;
                fileList.appendChild(li);

                li.querySelector('.file-list-element__delete').addEventListener('click', function() {
                    selectedFile = null;
                    fileInput.value = '';
                    updateFileList();
                    updateSubmitButton();
                });
            }
        }

        function updateSubmitButton() {
            submitBtn.disabled = !selectedFile;
        }
    </script>
@endsection

@section('menu_panoramas', 'active')
