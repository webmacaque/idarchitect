@extends('layouts.admin')

@section('content')
    <form class="block" method="post" action="{{ route('admin-panoramas-update', $panorama->id) }}" enctype="multipart/form-data">
        @csrf
        <span class="block-title page-title">Редактирование тура</span>
        
        <div class="panorama-form-field">
            <input
                type="text"
                name="name"
                id="name"
                class="input"
                required
                placeholder="Название тура"
                value="{{ $panorama->name }}"
            />
        </div>

        <div class="file-upload-component">
            <div class="file-input-container">
                <label class="custom-file-upload">
                    <input type="file" class="file-input" multiple name="images[]" accept="image/*" />
                    Нажмите на поле чтобы загрузить фото к проекту
                </label>
            </div>
            <ul class="file-list">
                @foreach($panorama->images as $image)
                    <li class="existing-file" data-id="{{ $image->id }}">
                        <span class="file-list-element__check">✓</span>
                        <span class="file-name">{{ $image->filename }}</span>
                        <span class="file-list-element__delete existing-delete" data-id="{{ $image->id }}">×</span>
                        <input type="hidden" name="remove_images[]" value="{{ $image->id }}" disabled class="remove-input" />
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="panorama-form-buttons">
            <button class="button" type="submit" id="submit-btn">Сохранить</button>
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

        document.querySelectorAll('.existing-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                const li = this.closest('li');
                const removeInput = li.querySelector('.remove-input');
                
                if (li.classList.contains('marked-for-removal')) {
                    li.classList.remove('marked-for-removal');
                    removeInput.disabled = true;
                    this.textContent = '×';
                } else {
                    li.classList.add('marked-for-removal');
                    removeInput.disabled = false;
                    this.textContent = '↩';
                }
                updateSubmitButton();
            });
        });

        fileInput.addEventListener('change', function(e) {
            const newFiles = Array.from(e.target.files);
            selectedFiles = [...selectedFiles, ...newFiles];
            updateNewFileList();
            updateSubmitButton();
        });

        function updateNewFileList() {
            document.querySelectorAll('.new-file').forEach(el => el.remove());
            
            selectedFiles.forEach((file, index) => {
                const li = document.createElement('li');
                li.className = 'new-file';
                li.innerHTML = `
                    <span class="file-list-element__check">✓</span>
                    <span class="file-name">${file.name}</span>
                    <span class="file-list-element__delete new-delete" data-index="${index}">×</span>
                `;
                fileList.appendChild(li);
            });

            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            fileInput.files = dataTransfer.files;

            document.querySelectorAll('.new-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const index = parseInt(this.dataset.index);
                    selectedFiles.splice(index, 1);
                    updateNewFileList();
                    updateSubmitButton();
                });
            });
        }

        function updateSubmitButton() {
            const nameInput = document.getElementById('name');
            const existingNotRemoved = document.querySelectorAll('.existing-file:not(.marked-for-removal)').length;
            const totalFiles = existingNotRemoved + selectedFiles.length;
            submitBtn.disabled = totalFiles === 0 || nameInput.value.trim() === '';
        }

        document.getElementById('name').addEventListener('input', updateSubmitButton);
    </script>
@endsection

@section('menu_panoramas', 'active')
