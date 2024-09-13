<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/admin/styles/normalize.css" />
    <link rel="stylesheet" href="/admin/styles/fonts.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />
    <link rel="stylesheet" href="/admin/styles/style.css" />
    <title>ID Architects</title>
</head>
<body>
<header class="header">
    <div class="content header-content">
        <a href="/">
            <img src="/admin/assets/svg/logo.svg" alt="logo" />
        </a>
        <nav class="header-menu">
            <a href="#" class="header-menu__link active">Список проектов</a>
            <a href="#" class="header-menu__link">Список администраторов</a>
        </nav>
    </div>
</header>
@if($project->home_page)
<div
    class="project-top"
    style="background-image: url('{{$project->mainPhoto->path}}')"
>
    <div class="content project-top-content">
        <div class="slide-content">
            <span class="slide-content__title">{{$project->name}}</span>
            <div class="slide-content__description">{{$project->description}}</div>
        </div>
    </div>
</div>
@endif
<div class="content">
    <div class="page-top">
        <a href="{{route('admin-projects')}}" class="page-top-back">
            <img src="/admin/assets/svg/back.svg" alt="back" />
            Назад
        </a>
        <div class="page-top-info">
            <span class="page-top-info__name">"{{$project->name}}"</span>
            <span class="page-top-info__year">{{$project->short_description}} / {{$project->year}}</span>
        </div>
    </div>
    <div class="project-description">{{$project->description}}</div>

    @foreach($photoTypes as $type)
        @if(array_key_exists($type->slug, $photos) && count($photos[$type->slug]) > 0)
            <span class="project-title">{{$type->name}}</span>
            @unless($type->slug==='360')
                <div class="project-photos">
                    @foreach($photos[$type->slug] as $i=>$photo)
                        <a
                            href="{{$photo->path}}"
                            data-fancybox="gallery"
                            data-caption="{{$type->name}} #{{$i+1}}"
                        >
                            <img src="{{$photo->path}}" />
                        </a>
                    @endforeach
                </div>
            @else
                <div id="panorama"></div>
                <div class="panorama-list">
                    @foreach($photos[$type->slug] as $photo)
                        <img
                            class="panorama-list__element"
                            data-image="{{$photo->path}}"
                            src="{{$photo->path}}"
                            alt="panorama"
                        />
                    @endforeach
                </div>
            @endunless
        @endif
    @endforeach
    <div class="project-bottom">
        <form action="{{route('admin-projects-edit-action', ['id' => $project->id])}}" method="post">
            @unless($project->is_published)
                <button class="button" name="action-publish">Опубликовать</button>
            @else
                <button class="button white" name="action-unpublish">Снять с публикации</button>
            @endunless
            @csrf
        </form>
        <div class="project-bottom-right">
            <a href="{{route('admin-projects-item-edit-form', $project->id)}}" class="button square white" title="Редактировать">
                <img src="/admin/assets/svg/edit.svg" />
            </a>
            <a href="#" class="button square white open-modal" title="Удалить">
                <img src="/admin/assets/svg/remove.svg" />
            </a>
        </div>
    </div>
    <footer>
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
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/pannellum@2.5.6/build/pannellum.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="/admin/assets/scripts/index.js"></script>

<script>
    const img = document.querySelectorAll(".panorama-list__element");
    img.forEach((element) => {
        element.addEventListener("click", () => {
            pannellum.viewer("panorama", {
                type: "equirectangular",
                panorama: element.dataset.image,
                autoLoad: true,
            });
        });
    });

    pannellum.viewer("panorama", {
        type: "equirectangular",
        panorama: img[0].src,
        autoLoad: true,
    });

    Fancybox.bind("[data-fancybox]", {});
</script>
</body>
</html>
