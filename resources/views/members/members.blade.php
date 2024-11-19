<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Участники сообщества</title>
</head>
<header class="header">
    <h1>МОСТ
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
    <main>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="profiles">
            @foreach($accounts as $account)
                <div class="members">
                    <div class="images">
                        <div  class="circle-image-members">
                            <a href="{{route('profile', $account)}}"> <img src="{{Storage::disk('images')->url($account->photo->photo_link)}}"></a> alt="Фотография участника" width="50">
                        </div>
                             {{$account->first_name . ' ' . $account->last_name}} <br/>
                                  {{$account->locality}}<br/>
                                      <div class="item" style="display: inline-block">
                                           <form action="{{route('members')}}" method="POST">
                                          @csrf
                                          <input hidden="id" name="id" value= {{$account->id}} required>
                                       <button>Добавить</button>
                                    </form>
                                 </div>
                             </div>
                       </div>
                   @endforeach
              </div>
        <footer> {{$accounts->links()}} </footer>
    </main>
<div style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); position: fixed; bottom: 0; right: 0; z-index:500;"> {{$date = date('d.m.Y')}}</div>
</body>
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
        padding: 20px;
    }

    .profiles {
        flex: 3;
        background: #ffffff;
        padding: 10px;
        width: 40%;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .circle-image-members{
        margin: auto;
        text-align: center;
        display: inline-block;
        border-radius: 50%;
        overflow: hidden;
        width: 100px;
        height: 100px;
    }
    .circle-image-members img{
        width:100%;
        height:100%;
        object-fit: cover;
    }
    .members {
        background: #e2e2e2;
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        display: grid;
        grid-template-columns: repeat(1, 1fr);
    }

    .images {
        display: grid;
        grid-template-columns: repeat(3,1fr);
        text-align: center;
        vertical-align: middle;
        position: relative;
    }
    a:hover img {
        opacity: 0.5;
    }

    .pagination {
        background: #e2e2e2;
        margin: 10px 0;
        border-radius: 5px;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
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
        background: #ffffff;
        color: #ffffff;
        position: relative;
        bottom: 0;
        width: 100%;
    }

</style>
