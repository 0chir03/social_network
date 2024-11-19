@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Диалоги</h3>
                <div class="list-group">
                    @foreach($conversations as $userId => $messages)
                        @php
                            $otherUser = $messages->first()->sender_id === Auth::id()
                                ? $messages->first()->receiver
                                : $messages->first()->sender;
                            $unreadCount = $messages->where('receiver_id', Auth::id())
                                ->whereNull('read_at')
                                ->count();
                        @endphp
                        <a href="{{ route('messages.show', $otherUser) }}"
                           class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $otherUser->name }}
                            @if($unreadCount > 0)
                                <span class="badge bg-primary rounded-pill">{{ $unreadCount }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection


