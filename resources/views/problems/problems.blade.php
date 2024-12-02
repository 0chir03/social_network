@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 style="text-align: center">Опишите вашу проблему</h2>
                <div class="messages-container">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{session('status')}}
                        </div>
                    @endif
                </div>
                <form action="{{route('problems')}}" enctype="multipart/form-data" method="POST" class="mt-3">
                    @csrf
                    <div class="form-group">
                    <textarea name="content" class="form-control" style="width: 100%" rows="3"
                              placeholder="Введите сообщение"></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Отправить</button>
                    </div>
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

        .message.sent .message-content {
            background-color: bisque;
            color: black;
        }

@endsection


