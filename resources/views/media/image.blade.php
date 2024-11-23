@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <h1 class="title">Фотографии</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{route('image')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="file" name="file" multiple accept="image/*"/></label><br/>
            <button type="submit" id="submit">Создать</button>
        </form>
        <div class="block_size">
            @if(isset($images) === true)
                @foreach($images as $image)
                    <div class="block_img">
                        <img src="{{Storage::disk('images')->url($image->image_link)}}" alt="Фотография">
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

<style>

    .block_size {
        display: flex; /* Меняем на flex вместо inline-block */
        justify-content: flex-start; /* Выравнивание элементов слева */
        align-items: center;
        flex-wrap: wrap; /* Позволяет переносить элементы на новую строку при нехватке места */
        gap: 20px; /* Отступ между элементами */
    }

    .block_img {
        width: 300px; /* Фиксированная ширина блока */
        height: 300px; /* Фиксированная высота блока */
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
</style>
