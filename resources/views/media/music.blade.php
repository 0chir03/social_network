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
        <h1 class="title">Аудиозаписи</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{route('music')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="file" name="file" accept="audio/*" multiple /></label><br/>
            <button type="submit" id="submit">Создать</button>
        </form>
            @if(isset($musics) === true)
                @foreach($musics as $music)
                    <div class="block_msc">
                        <audio controls src="{{Storage::disk('music')->url($music->music_link)}}"></audio>
                    </div>
                @endforeach
            @endif
    </div>
@endsection

<style>

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
