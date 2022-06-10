@php
\Carbon\Carbon::setLocale('vi');
@endphp
@foreach($messages as $message)

    @if($message->type == 0)
<div class="direct-chat-msg">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-timestamp float-left">{{ $message->created_at->diffForHumans() }}</span>
    </div>

    <img class="direct-chat-img" src="{{ asset($message->user->profile->image) }}" alt="message user image">

    <div class="direct-chat-text"
         style="display: inline-block; float: left; margin-left: 10px !important;">
        {{ $message->content }}
    </div>

</div>

    @else

<div class="direct-chat-msg right">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-timestamp float-right">{{ $message->created_at->diffForHumans() }}</span>
    </div>

    <img class="direct-chat-img" src="{{ asset($message->user->profile->image) }}" alt="message user image">

    <div class="direct-chat-text"
         style="display: inline-block; float: right; margin-right: 10px !important;">
        {{ $message->content }}
    </div>

</div>

    @endif

@endforeach
