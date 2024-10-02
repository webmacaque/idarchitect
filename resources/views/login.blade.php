<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="/admin/styles/normalize.css" />
    <link rel="stylesheet" href="/admin/styles/fonts.css" />
    <link rel="stylesheet" href="/admin/styles/style.css" />
    <title>ID Architects</title>
</head>
<body>
<div class="wrapper-login">
    <div class="login">
        <a href="{{route('index')}}"><img class="login__logo" src="/admin/assets/svg/logo.svg" alt="logo" /></a>
        <form class="login-content" action="" method="post">
            @csrf
            @error('login'){{$message}}@enderror
            <input
                type="text"
                name="login"
                id="login"
                placeholder="Введите логин"
                required
                oninput="loginButton()"
                class="input login__input"
                value="{{old('login')}}"
            />
            <input
                type="password"
                name="password"
                id="password"
                placeholder="Введите пароль"
                required
                oninput="loginButton()"
                class="input login__input"
            />
            <div class="login-bottom">
                <div>
                    <input
                        name="remember"
                        type="hidden"
                        value="0"
                    /><input
                        id="checkbox-1"
                        class="checkbox-custom"
                        name="remember"
                        type="checkbox"
                        value="1"
                    />
                    <label for="checkbox-1" class="checkbox-custom-label"
                    >Запомните меня</label
                    >
                </div>
                <button disabled id="submitBtn" class="button" type="submit">Войти</button>
            </div>
        </form>
    </div>
</div>
<script src="/admin/assets/scripts/index.js"></script>
</body>
</html>

