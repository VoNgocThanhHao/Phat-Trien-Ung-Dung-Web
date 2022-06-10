@foreach($comments as $comment)

    @if(!Auth::user() || Auth::user()->id != $comment->user_id)

<div class="direct-chat-msg mt-4">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-left">{{ $comment->user->name }}</span>
        <span class="direct-chat-timestamp float-left ml-3">{{ $comment->created_at->format('d-m-Y') }}</span>
    </div>
    <img class="direct-chat-img" src="{{ asset($comment->user->profile->image) }}" alt="message user image">
    <div class="direct-chat-text" style="display: inline-block; float: left; margin-left: 10px !important;">
        {{ $comment->content }}
    </div>
</div>

    @else

<div class="direct-chat-msg mt-4 right">
    <div class="direct-chat-infos clearfix">
        <span class="direct-chat-name float-right">{{ $comment->user->name }}</span>
        <span class="direct-chat-timestamp float-right mr-3">{{ $comment->created_at->format('d-m-Y') }}</span>
    </div>

    <img class="direct-chat-img" src="{{ asset($comment->user->profile->image) }}" alt="message user image">

    <div class="direct-chat-text" style="display: inline-block; float: right; margin-right: 10px !important;">
        {{ $comment->content }}
    </div>
</div>


    @endif


@endforeach
