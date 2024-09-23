@extends('layouts.admin')

@section('content')
    <form class="block" method="post" enctype="multipart/form-data">
        @csrf
        <span class="block-title page-title">Создание проекта</span>
        <div class="create-line">
            <input
                type="text"
                name="name"
                id="name"
                class="input"
                required
                placeholder="Введите название проекта *"
            />
            <select required class="select-type" name="type">
                @foreach($projectTypes as $type)
                    <option value="{{$type->id}}">{{$type->short_name}}</option>
                @endforeach
            </select>
        </div>
        <div class="create-line">
            <input
                type="text"
                name="short_description"
                id="name"
                class="input"
                required
                placeholder="Введите краткое описание проекта *"
            />
            <select required class="select-year" name="year">
                @for($i=$currentYear; $i>$currentYear-20; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <textarea
            placeholder="Добавьте полное описание проекта"
            name="description"
            class="textarea"
        ></textarea>
        <div class="create-bottom-field">
            <div>
                <input type="hidden" name="home_page" value="0">
                <input
                    id="checkbox-1"
                    class="checkbox-custom"
                    name="home_page"
                    value="1"
                    type="checkbox"
                />
                <label for="checkbox-1" class="checkbox-custom-label">
                    Добавить на главную
                </label>
            </div>
            <span class="create-bottom-field__required">*Обязательное поле</span>
        </div>

        @foreach($photoTypes as $type)
            <div class="file-upload-component">
                <span class="subtitle">{{$type->name}}</span>
                <div class="file-input-container">
                    <label class="custom-file-upload">
                        <input type="file" class="file-input" multiple name="photo[{{$type->id}}][]"  accept="image/*"/>
                        Нажмите на поле чтобы загрузить фото к проекту
                    </label>
                </div>
                <ul class="file-list"></ul>
            </div>
        @endforeach

        <div class="create-bottom">
            <button class="button" type="submit">Создать проект</button>
            <button class="button" name="action-publish">Опубликовать</button>
        </div>
    </form>
@endsection

@section('scripts')
    @parent
    <script>
        new Choices(".select-type", {
            searchEnabled: false,
            itemSelectText: false,
            shouldSort: false,
            placeholder: true,
            placeholderValue: "Выберите тип проекта *",
        });
        new Choices(".select-year", {
            searchEnabled: false,
            itemSelectText: false,
            shouldSort: false,
            placeholder: true,
            placeholderValue: "Выберите год проекта *",
        });
    </script>
@endsection

@section('menu_projects', 'active')

