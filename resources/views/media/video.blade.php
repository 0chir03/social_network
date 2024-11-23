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
        <h1 class="title">Видеозаписи</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{route('video')}}" enctype="multipart/form-data" method="post">
            @csrf
            <input type="file" name="file" accept="video/*" multiple /></label><br/>
            <button type="submit" id="submit">Создать</button>
        </form>
        @if(isset($videos) === true)
            @foreach($videos as $video)
                <video width="320" height="240" controls>
                    <source src="{{Storage::disk('video')->url($video->video_link)}}" type="video/mp4">
                </video>
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
