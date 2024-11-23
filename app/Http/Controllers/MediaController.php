<?php

namespace App\Http\Controllers;

use App\Models\Mediafile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController
{
    public function image()
    {
        $images = Mediafile::query()->whereNotNull('image_link')
                                     ->where('user_id', Auth::id())
                                     ->get();

        return  view('media.image', ['images' => $images]);
    }

    public function music()
    {
        $musics = Mediafile::query()->whereNotNull('music_link')
            ->where('user_id', Auth::id())
            ->get();

        return  view('media.music',  ['musics' => $musics]);
    }

    public function video()
    {
        $videos = Mediafile::query()->whereNotNull('video_link')
            ->where('user_id', Auth::id())
            ->get();

        return  view('media.video', ['videos' => $videos]);
    }

      //Добавление изображений
    public function addImage(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:20000'
        ]);

        Mediafile::query()->create([
             'user_id'=> Auth::id(),
            'image_link' => $request->file('file')->store('', 'images'),
        ]);

        return redirect('/image')->with('status', 'Файл успешно загружён');
    }

    //Добавление аудиозаписей
    public function addMusic(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:50000'
        ]);

        Mediafile::query()->create([
            'user_id'=> Auth::id(),
            'music_link' => $request->file('file')->store('', 'music'),
        ]);

        return redirect('/music')->with('status', 'Файл успешно загружён');
    }

    //Добавление видеозаписей
    public function addVideo(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|file|max:50000'
        ]);

        Mediafile::query()->create([
            'user_id'=> Auth::id(),
            'video_link' => $request->file('file')->store('', 'video'),
        ]);

        return redirect('/video')->with('status', 'Файл успешно загружён');
    }

}
