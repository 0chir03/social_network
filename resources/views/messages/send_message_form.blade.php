@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 style="text-align: center">Диалог с {{$user->account->first_name }}</h3>
                <div class="messages-container">
                    @foreach($messages as $message)
                        <div class="message {{ $message->sender_id === Auth::id() ? 'sent' : 'received' }}">
                            <div class="message-content">
                                {{ $message->content }}
                            </div>
                            <div class="message-time">
                                {{ $message->created_at->format('H:i') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <form action="{{ route('messages.store', $user) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                    <textarea name="content" class="form-control" rows="3"
                              placeholder="Введите сообщение"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Отправить</button>
                </form>
            </div>
        </div>
    </div>

    <style>

        .container {
            margin-left: auto;
            margin-right: auto;
            max-width: 50%;
        }
        .messages-container {
            max-height: 600px;
            overflow-y: auto;
            padding: 20px;
        }

        .message {
            margin-bottom: 15px;
            max-width: 70%;
        }

        .message.sent {
            margin-right: auto;
        }

        .message.received {
            margin-left: auto;
        }

        .message-content {
            padding: 10px;
            border-radius: 10px;
            background-color: bisque;
        }

        .message.sent .message-content {
            background-color: bisque;
            color: black;
        }

        .message-time {
            font-size: 0.8em;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
@endsection
