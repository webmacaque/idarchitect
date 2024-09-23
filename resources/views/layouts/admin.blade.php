<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="/admin/styles/normalize.css" />
    <link rel="stylesheet" href="/admin/styles/fonts.css" />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css"
    />
    @yield('styles')
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
            <a href="{{route('admin-projects')}}" class="header-menu__link @yield('menu_projects','')">Список проектов</a>
            <a href="{{route('admin-users')}}" class="header-menu__link @yield('menu_users','')">Список администраторов</a>
        </nav>
    </div>
</header>
@yield('home_page_preview', '')
<div class="content">
    @yield('content')
</div>
<footer>
    @yield('footer')
</footer>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="/admin/assets/scripts/index.js"></script>
@show

</body>
</html>

