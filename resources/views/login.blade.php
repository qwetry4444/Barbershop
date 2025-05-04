<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style> .is-invalid { color: red }</style>
    <title>Login</title>
</head>
<body>
    @if($user)
        <h2>Здравствуйте, {{$user->name}}</h2>
        <a href="{{url('logout')}}">Выйти</a>
    @else
        <h2>Вход</h2>
        <form action="{{url('auth')}}" method="post">
            @csrf
            <label>E-mail</label>
            <input type="text" name="email" value="{{old('email')}}">
            @error('email')
            <div class="is-invalid">{{ $message }}</div>
            @enderror
            <br>
            @csrf
            <label>Пароль</label>
            <input type="password" name="password" value="{{old('password')}}">
            @error('password')
            <div class="is-invalid">{{ $message }}</div>
            @enderror
            <br>
            <button type="submit">Войти</button>
        </form>
        @error('error')
        <div class="is-invalid">{{ $message }}</div>
        @enderror
    @endif
</body>
</html>
