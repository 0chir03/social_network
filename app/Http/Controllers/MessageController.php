<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use App\Models\MessageFile;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


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
    public function send(MessageRequest $request, User $user)
    {
        $validated = $request->validated();

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

        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'rmuser', 'rmpassword');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        $msg = new AMQPMessage($message);
        $channel->basic_publish($msg, '', 'hello');

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
