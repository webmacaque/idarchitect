@extends('layouts.admin')

@section('content')
    <form class="block" method="post" enctype="multipart/form-data">
        @csrf
        <span class="block-title page-title">Редактирование</span>
        <div class="create-line">
            <input
                type="text"
                name="name"
                id="name"
                class="input"
                required
                placeholder="Введите название проекта *"
                value="{{$project->name}}"
            />
            <select required class="select-type" name="type">
                @foreach($projectTypes as $type)
                    <option value="{{$type->id}}" {{$project->projectType->id==$type->id?'selected':''}}>{{$type->short_name}}</option>
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
                value="{{$project->short_description}}"
            />
            <select required class="select-year" name="year">
                @for($i=$currentYear; $i>$currentYear-20; $i--)
                    <option value="{{$i}}" {{$i==$project->year?'selected':''}}>{{$i}}</option>
                @endfor
            </select>
        </div>
        <textarea
            placeholder="Добавьте полное описание проекта"
            class="textarea"
            name="description"
        >{{$project->description}}</textarea>
        <div class="create-bottom-field">
            <div>
                <input type="hidden" name="home_page" value="0">
                <input
                    id="checkbox-1"
                    class="checkbox-custom"
                    name="home_page"
                    type="checkbox"
                    value="1"
                    {{$project->home_page?'checked':''}}
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
                <div class="files-uploaded">
                    @foreach($project->photosByType($type->slug)->get() as $photo)
                        <div class="file-uploaded">
                            <div class="file-uploaded-top">
                                <span class="file-uploaded__name">{{($photo->filename)}}</span>
                                <div class="file-upload-actions">
                                    <label class="file-uploaded__favorite">
                                        <input
                                            type="radio"
                                            name="favorite_photo"
                                            id="fav-photo-1"
                                            value="{{$photo->id}}"
                                            {{$photo->main?'checked':''}}
                                        />
                                        <span></span>
                                    </label>
                                    <label class="file-uploaded__remove">
                                        <input type="checkbox" name="remove_photo[{{$photo->id}}]" id="photo-1" />
                                    </label>
                                </div>
                            </div>
                            <div class="file-uploaded-image">
                                <img
                                    class="file-uploaded__image"
                                    src="{{$photo->path}}"
                                    alt=""
                                />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

        <div class="create-bottom">
            <button class="button" name="edit-save">Cохранить</button>
            <div class="create-bottom-right">
                @unless($project->is_published)
                    <button class="button" name="action-publish">Опубликовать</button>
                @else
                    <button class="button white" name="action-unpublish">Снять с публикации</button>
                @endunless
                <a href="{{route('admin-projects-item-preview', $project->id)}}" class="button white square">
                    <img src="/admin/assets/svg/show.svg" alt="" />
                </a>
                <a href="#" class="button white square open-modal"  title="Удалить" data-remove="{{$project->id}}">
                    <img src="/admin/assets/svg/remove.svg" alt="" />
                </a>
            </div>
        </div>
        <input type="hidden" name="page" value="edit" />
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

@section('footer')
    @include('admin.delete-modal', [
    'title'=>'Удаление проекта',
    'description' => 'Вы действительно хотите удалить всю информацию о выбранном проекте?',
    'action' => route('admin-projects-delete')
    ])
@endsection

@section('menu_projects', 'active')
