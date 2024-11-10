<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<h1>Регистрация</h1>

@if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('register') }}" method="POST">
    @csrf
    <div>
        <label for="name">Имя:</label>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
    </div>
    <div>
        <label for="password">Пароль:</label>
        <input type="password" name="password" required>
    </div>
    <div>
        <label for="password_confirmation">Подтверждение пароля:</label>
        <input type="password" name="password_confirmation" required>
    </div>
    <div>
        <label for="phone">Телефон (необязательно):</label>
        <input type="text" name="phone" value="{{ old('phone') }}">
    </div>
    <button type="submit">Зарегистрироваться</button>
</form>
</body>
</html>
