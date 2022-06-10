@foreach($users as $user)

    <div class="card cardUser" style="cursor: pointer; position: relative" data="{{ $user }}" data_img="{{ $user->profile->image }}">
        @if(($user->message->sortByDesc('created_at')->first()->read) == 0)
            <span class="text-danger textSeen" style="position: absolute; top: 5px; right: 5px">
                            <div class="bg-primary" style="border-radius: 50%; height: 15px; width: 15px"></div>
                        </span>
        @endif
        <div class="card-body" style="padding: 5px 15px;">
            <div class="row align-items-center">
                <img src="{{ asset($user->profile->image) }}" alt=""
                     style="border-radius: 50%; float: left; width: 20%">
                <span class="ml-2">{{ $user->name }}</span>
            </div>
        </div>
    </div>

@endforeach
