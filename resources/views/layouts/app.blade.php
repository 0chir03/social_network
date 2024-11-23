<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личная страница</title>
</head>
<body>
<header class="header">
    <h1 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5)">МОСТ
        <section style="margin-left: 5px; float:left">
            <form action="{{ route('my_page') }}" method="POST">
                @csrf
                <button>Моя страница</button>
            </form>
        </section>
        <section style="margin-right: 5px; float: right">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button>Выйти</button>
            </form>
        </section>
    </h1>
</header>

<main>
    @section('content')
    @show
</main>

<div style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); position: fixed; bottom: 0; right: 0; z-index:500;">
    {{$date = date('d.m.Y')}}
</div>
</body>
</html>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }

    header {
        background: #35424a;
        color: #ffffff;
        padding: 2px 0;
        text-align: center;
    }

    /* Добавляем стили для контейнера с фотографиями */
    .container {
        padding: 10px;
        margin: 0 auto;
    }

    .block_size {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
        align-items: center;
    }

    .block_img {
        width: 300px;
        height: 300px;
        border-radius: 5px;
        border: 5px solid #fff;
        box-shadow: 2px 1px 5px #999999;
        position: relative;
        overflow: hidden;
        flex: 0 0 auto;
    }

    .block_img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 1s;
    }

    .block_img img:hover {
        transform: scale(1.1);
    }

    /* Остальные стили остаются без изменений */
    nav ul {
        list-style: none;
        padding: 0;
    }

    nav ul li {
        display: inline;
        margin: 0 15px;
    }

    nav ul li a {
        color: #ffffff;
        text-decoration: none;
    }

    button {
        padding: 10px 15px;
        background-color: #35424a;
        color: white;
        border: 1px solid #000000;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45657d;
    }

    footer {
        text-align: center;
        padding: 10px 0;
        background: #35424a;
        color: #ffffff;
        position: relative;
        bottom: 0;
        width: 100%;
    }
</style>
