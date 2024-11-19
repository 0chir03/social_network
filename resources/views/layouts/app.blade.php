<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Личная страница</title>
</head>
<header class="header">
    <h1 style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5)">МОСТ
        <section  style="margin-left: 5px; float:left" >
            <form  action="{{ route('my_page') }}" method="POST">
                @csrf
                <button>Моя страница</button>
            </form>
        </section>
        <section style = "margin-right: 5px; float: right">
            <form  action="{{ route('logout') }}" method="POST">
                @csrf
                <button>Выйти</button>
            </form>
        </section>
    </h1>
</header>
<body>
    @section('content')

    @show
    <div style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); position: fixed; bottom: 0; right: 0; z-index:500;"> {{$date = date('d.m.Y')}}</div>
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

    main {
        display: flex;
        justify-content: space-around;
        padding: 20px;
    }
    a {
        text-transform: uppercase;
        text-decoration: none;
        font-family: helvetica;
        font-weight: bold;
        color: black;
    }

    textarea {
        width: 100%;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-bottom: 10px;
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
