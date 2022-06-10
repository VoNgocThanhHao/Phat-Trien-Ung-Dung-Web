
    @if(count($messages) == 0)
        <h5 class="text-center"><strong>Điện máy Đen</strong> rất vui khi được giúp đỡ bạn!</h5>
    @else
    @foreach($messages as $message)
        @if($message->type == 1)
    <div class="direct-chat-msg">
        <img class="direct-chat-img" src="{{ asset('public/mySource/imgs/logo/logo_v3.png') }}"
             alt="message user image">

        <div class="direct-chat-text"
             style="display: inline-block; float: left; margin-left: 10px !important;">
            {{ $message->content }}
        </div>
    </div>

        @else

    <div class="direct-chat-msg right">
        <img class="direct-chat-img" src="{{ asset(Auth::user()->profile->image) }}"
             alt="message user image">

        <div class="direct-chat-text"
             style="display: inline-block; float: right; margin-right: 10px !important;">
            {{ $message->content }}
        </div>
    </div>

        @endif

    @endforeach
    @endif
