<?php

namespace App\Http\Controllers;


use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\MessageFile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController
{

    public function index()
    {

        $conversations = Message::where('sender_id', Auth::id())
            ->orWhere('receiver_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($message) {
                return $message->sender_id === Auth::id()
                    ? $message->receiver_id
                    : $message->sender_id;
            });

        return view('messages.message' , compact('conversations'));
    }

    public function show(User  $user)
    {
        $messages = Message::where(function($query) use ($user) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $user->id);
        })->orWhere(function($query) use ($user) {
            $query->where('sender_id',  $user->id)
                ->where('receiver_id', Auth::id());
        })
            ->orderBy('created_at', 'asc')
            ->get();

        // Отмечаем сообщения как прочитанные
        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('messages.send_message_form', compact('messages', 'user'));
    }

    //Отправка сообщений
    public function send(Request $request, User $user)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
            'file' => 'sometimes|file|max:20000'
        ]);

        //текстовое сообщение
        $message = Message::query()->create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'content' => $validated['content'],
        ]);

        //сообщение с медиаконтентом
        if (isset($validated['file']) === true) {
            MessageFile::query()->create([
                'message_id' => $message->id,
                'file_link' => $request->file('file')->store('', 'message')
            ]);
        }

        event(new MessageEvent($message));

        return back()->with('status', 'Сообщение отправлено');
    }

    public function getUnreadCount()
    {
        $count = Message::where('receiver_id', Auth::id())
            ->whereNull('read_at')
            ->count();

        return response()->json(['count' => $count]);
    }
}
