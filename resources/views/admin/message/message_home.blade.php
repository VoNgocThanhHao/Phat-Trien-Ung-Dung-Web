@extends('admin.master')
@section('header') Tin nhắn
@endsection

@section('content')
    <div class="row pl-2 pr-2">

        <div class="col-md-3 pr-2">
            <div class="card card-default">
                <div class="card-body boxListUser" style="height:80vh; overflow-y: scroll;">


                    {{--                    danh sach user--}}

                </div>
            </div>
        </div>


        <div class="col-md-9">
            <div class="card direct-chat direct-chat-primary card-default ">
                <div class="card-header boxContent" data="">
                    <img class="direct-chat-img imgChat" src="{{ asset('public/mySource/imgs/logo/logo_v3.png') }}"
                         alt="message user image">
                    <div class="mt-2">
                        <span class="ml-2 nameChat"> <b>Điện máy Đen</b></span>
                    </div>
                </div>

                <div class="card-body boxMessAdmin" style="height:65vh; overflow-y: scroll; padding: 10px 20px">


                    {{--danh sach tin nhan--}}


                </div>


                <div class="card-footer">
                    <div class="input-group">
                        <input type="text" name="" placeholder="Aa..."
                               class="form-control contentChat">
                        <span class="input-group-append">
<button type="button" class="btn btn-primary btnSent">Gửi</button>
</span>
                    </div>
                </div>


            </div>
        </div>


    </div>



@endsection

@section('script')

    <script>


        var getListUser = function () {

            $.ajax({
                url: '{{ action('App\Http\Controllers\messageController@getListUser') }}',
                type: "GET",
                data: {},
                success: function (result) {
                    $('.boxListUser').html(result)

                    $('.cardUser').each(function () {
                        var data = JSON.parse($(this).attr('data'))

                        if (data.id.toString() === $('.boxContent').attr('data')) {
                            console.log($(this))
                            $(this).css('background-color', 'rgba(0, 0, 0, 0.5)').css('color', 'white')
                        }
                    })
                }
            });


        }

        var getListMess = function (id) {
            $.ajax({
                url: '{{ action('App\Http\Controllers\messageController@getListAdmin') }}',
                type: "GET",
                data: {
                    'id': id,
                },
                success: function (result) {
                    $('.boxMessAdmin').html(result)
                    $('.boxMessAdmin').scrollTop($('.boxMessAdmin').height() + 9999);
                    get_count(1)
                }
            });
        }

        var sentMess = function () {

            var id = $('.boxContent').attr('data')

            if ($('.contentChat').val() === '') return

            if (id === '') return;


            $.post("{{ action('App\Http\Controllers\messageController@sentMessAdmin') }}", {
                "message": $('.contentChat').val(),
                "id": id
            })
            $('.contentChat').val('')
        }


        $(document).ready(function () {

            getListUser()


            @foreach($users as $user)
            window.Echo.channel('chat')
                .listen('.chat-{{ $user->id }}', (e) => {
                    // console.log(e.user.id);
                    if ($('.boxContent').attr('data') === '{{ $user->id }}') {
                        getListMess($('.boxContent').attr('data'))
                    }
                    if({{ $user->id }} === e.user.id) get_count(1)
                    else get_count()
                    getListUser()

                });
            @endforeach

            $(document).on('click', '.btnSent', function () {
                sentMess()
            })
            $('.contentChat').on('keypress', function (e) {
                if (e.which == 13) {
                    sentMess()
                }
            });


            $(document).on('click', '.cardUser', function () {
                $('.cardUser').each(function () {
                    $(this).css('background-color', 'white').css('color', 'black')
                })
                $(this).css('background-color', 'rgba(0, 0, 0, 0.5)').css('color', 'white')

                $(this).find('.textSeen').hide()

                var data = JSON.parse($(this).attr('data'))

                $('.nameChat').html(data.name)

                $('.imgChat').attr('src', 'http://' + document.domain + '/' + $(this).attr('data_img'))

                $('.boxContent').attr('data', data.id)

                getListMess(data.id)


            })


        });


    </script>

@endsection



