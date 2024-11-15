<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Личная страница</title>
</head>
<header class="header">
    <h1>МОСТ
        <section>
            <form  action="{{ route('logout') }}" method="POST">
                @csrf
                <button>Выйти</button>
            </form>
        </section>
    </h1>
</header>
<body>
    <div style="display: flex;">
        <div class="profile" >
                <span class="circle-image">
                    <img src="{{Storage::disk('images')->url($account->photo->photo_link)}}" alt="Фотография пользователя" width="300">
                </span>
                <div class="profile-info">
                    <h2>{{$user->account->first_name . ' ' . $user->account->last_name}}</h2>
                    <p>Возраст: {{\Carbon\Carbon::parse($user->account->date_of_birth)->age}}</p>
                    <p>Населенный пункт: {{$user->account->locality}}</p>
                    <p>Род деятельности: {{$user->account->career}}</p>
                    <p>Хобби: {{$user->account->hobby}}</p>
                </div>
                <a href="{{route('members')}}">Участники сообщества</a><br><br>
                <a href="{{route('subscribers')}}">Друзья и подписчики</a>
            </div>
         </div>
    <div class="message">
        <h2>Отправить сообщение</h2>
        <textarea placeholder="Напишите сообщение..." rows="3"></textarea>
        <button type="button">Отправить</button>
    </div>
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
    section {
        margin-right: 5px;
        float: right;
    }

    .circle-image{
        display: inline-block;
        border-radius: 50%;
        overflow: hidden;
        width: 200px;
        height: 200px;
    }
    .circle-image img{
        width:100%;
        height:100%;
        object-fit: cover;
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

    .profile {
    padding: 10px;
    width: 50%;
    }

    .message {
        width: 50%;
        padding: 5px;
    }

    .members {
    background: #e2e2e2;
    padding: 10px;
    margin: 10px 0;
    border-radius: 5px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    }

    .images {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
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
