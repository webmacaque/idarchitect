@extends('layouts.admin')

@section('content')
    <div class="projects-filter">
        <span class="page-title">Список проектов</span>
        <form class="projects-filter-form" method="get">
            <select class="select" id="project-filter-select" name="type">
                <option data-display="Select" value="">Все проекты</option>
                <option value="home_page" {{$filterType=='home_page'?'selected':''}}>На главную</option>
                @foreach($projectTypes as $type)
                    <option value="{{$type->id}}" {{$filterType==$type->id?'selected':''}}>{{$type->short_name}}</option>
                @endforeach
            </select>
            <div class="projects-filter-form-search">
                <img
                    class="projects-filter-search-icon"
                    src="/admin/assets/svg/search.svg"
                    alt="поиск"
                />
                <input
                    type="text"
                    name="project_name"
                    id="project-name"
                    placeholder="Поиск по названию"
                    class="input input--logo"
                    value="{{$filterName}}"
                />
            </div>
        </form>
        <a href="{{route('admin-projects-create-form')}}" class="button">Создать проект</a>
    </div>
    @foreach($projects as $project)
        <div class="projects-list-element {{$typesBgs[$project->projectType->slug]}}">
            <div>
                <span class="projects-list-element__type">{{$project->projectType->short_name}}</span>
                <div class="projects-list-element-name">
                    @if($project->home_page)
                        <img
                            src="/admin/assets/svg/star-filled.svg"
                            class="projects-list-element-name__favorite"
                            alt="favorite"
                        />
                    @endif
                    <span class="projects-list-element-name__title">{{$project->name}}</span>
                </div>
                <span class="projects-list-element__year">{{$project->short_description}} / {{$project->year}}</span>
                <div class="projects-list-element-content">{{$project->description}}</div>
            </div>
            <div class="projects-list-element-control">
                <form action="{{route('admin-projects-edit-action', ['id' => $project->id])}}" method="post">
                    @if($project->is_published)
                        <button
                            class="button button--p10 white projects-list-element-control__publish"
                            name="action-unpublish"
                        >
                            Снять с публикации
                        </button>
                    @else
                        <button
                            class="button button--p10 projects-list-element-control__publish"
                            name="action-publish"
                        >
                            Опубликовать
                        </button>
                    @endif
                    @csrf
                    <input type="hidden" name="page" value="projects">
                </form>
                <div class="projects-list-element-control__bottom">
                    <a href="{{route('admin-projects-item-edit-form', $project->id)}}" class="button square white" title="Редактировать">
                        <img src="/admin/assets/svg/edit.svg" />
                    </a>
                    <a href="{{route('admin-projects-item-preview', $project->id)}}" class="button square white" title="Просмотр">
                        <img src="/admin/assets/svg/show.svg" />
                    </a>
                    <a href="#" class="button square white open-modal" title="Удалить">
                        <img src="/admin/assets/svg/remove.svg" />
                    </a>
                </div>
            </div>
        </div>
    @endforeach
    {{$projects->withQueryString()->links('pagination.default', ['onEachSide'=>2])}}
@endsection

@section('footer')
    <div id="overlay" class="overlay"></div>

    <div id="modal" class="modal" popover="manual">
        <span class="modal__title">Удаление проекта</span>
        <div class="modal__description">
            Вы действительно хотите удалить всю информацию о выбранном проекте?
        </div>
        <form class="modal-buttons">
            <button class="button">Да</button>
            <button class="button white" id="closeModalBtn">Нет</button>
        </form>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        const choices = new Choices(".select", {
            searchEnabled: false,
            itemSelectText: false,
            shouldSort: false,
        });

        choices.passedElement.element.addEventListener(
            "choice",
            function (event) {
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set("type", event.detail.value);
                window.history.pushState({}, "", currentUrl);
                document.location=currentUrl;
            },
            false
        );
    </script>
@endsection

@section('menu_projects', 'active')
