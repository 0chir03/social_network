<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
<main>
    <div class="profiles">
        <p>Ваши друзья</p>
            @foreach($subscribers as $subscriber)
                @if($subscriber->accepted === true)
                    <div class="members">
                        <div class="images">
                            <div  class="circle-image-members">
                                <a href="{{route('profile', $subscriber->account)}}"> <img src="{{Storage::disk('images')->url($subscriber->account->photo->photo_link)}}"> </a> alt="Фотография участника" width="50">
                                     </div>
                                            {{$subscriber->account->first_name . ' ' . $subscriber->account->last_name}}<br/>
                                                 {{$subscriber->account->locality}}<br/>
                                                    <form action="{{route('send', $subscriber->account->user_id)}}" method="POST">
                                                       @csrf
                                            <textarea name="content" class="form-control" placeholder="Напишите сообщение другу..." rows="3"></textarea>
                                        <div class="item"><button>Написать</button></div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                 </div>
            <div class="profiles" >
                @if (session('info'))
                    <div class="alert alert-success">
                        {{ session('info') }}
                    </div>
                @endif
              <p>Запросы в друзья</p>
                 @if(isset($usersObjRequest) === true)
                    @foreach($usersObjRequest as $userObjRequest)
                         @foreach($userObjRequest as $item)
                            @if(!empty($item) AND $item->accepted === false)
                                    <div class="members">
                                        <div class="images">
                                            <div  class="circle-image-members">
                                                <img src="{{Storage::disk('images')->url($item->photo_link)}}" alt="Фотография участника" width="50">--}}
                                                    </div>
                                                        {{$item->first_name . ' ' . $item->last_name}}<br/>
                                                        {{$item->locality}}<br/>
                                                        <form method="POST" class="acceptRequest">
                                                    @csrf
                                                <input type="hidden" id="user_id" name="user_id" value="{{$item->user_id}}" required>
                                            <button type="button">Принять запрос</button>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                 @endif
            </div>
</main>
    <footer> {{$subscribers->links()}} </footer>
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
        display: flex;
    }

    .profiles {
        flex: 3;
        background: #ffffff;
        padding: 10px;
        width: 40%;
        border-radius: 8px;
        margin-left: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
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
        grid-template-columns: repeat(3, 1fr);
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

    p {
        color: black;
        font-size: 24px;
        font-weight: bold;
        font-style: oblique;
    }

    textarea {
        width: 80%;
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $("document").ready(function() {
        $('.acceptRequest button').on('click', function() {

            var form = $(this).closest('.acceptRequest');
            var userId = form.find('#user_id').val();

            $.ajax({
                type: "POST",
                url: "/subscribers",
                data: { 'user_id': userId,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data === 'Успешно')
                        var messageDiv = $('<div>', {
                            text: 'Запрос принят',
                            class: 'success-message',
                            css: {
                                position: 'fixed',
                                top: '20px',
                                left: '50%',
                                transform: 'translateX(-50%)',
                                backgroundColor: 'green',
                                color: 'white',
                                padding: '10px 20px',
                                borderRadius: '5px',
                                zIndex: '1000'
                            }
                        });
                    // Добавляем сообщение на страницу
                    $('body').append(messageDiv);
                    // Удаляем сообщение через 3 секунды
                    setTimeout(function() {
                        messageDiv.fadeOut(300, function() {
                            $(this).remove();
                        });
                    }, 3000);
                    //блокировка кнопки после принятия запроса
                    form.find('button').prop('disabled', true);
                }
            });
        });

    });
</script>
