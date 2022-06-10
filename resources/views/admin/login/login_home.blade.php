<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{ asset('public/mySource/style/login.css') }}">
</head>
<body>
<section>
    <div class="imgBx">
        <img src="{{ asset('public/mySource/imgs/background/background-login.jpg') }}" alt="">
    </div>
    <div class="contentBx">
        <div class="formBx">
            <h2>Đăng nhập</h2>
            <div class="inputBx">
                <span>Email</span>
                <input class="email" type="text" name="">
            </div>
            <div class="inputBx">
                <span>Mật khẩu</span>
                <input class="password" type="password" name="">
            </div>
            <div class="inputBx" style="margin-top: 40px;">
                <button class="btnLogin" name="">Đăng nhập</button>
            </div>

        </div>
    </div>
</section>

<script src="{{asset("public/plugins/jquery/jquery.min.js")}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    var LOGIN = '{{ action('App\Http\Controllers\loginController@loginAdmin') }}'


    $(document).ready(function () {

        $('.btnLogin').click(function () {
            $.ajax({
                url: LOGIN,
                type: "POST",
                data: {
                    '_token': '{{csrf_token()}}',
                    'email': $('.email').val(),
                    'password': $('.password').val(),
                },
                success: function (result) {
                    result = JSON.parse(result);
                    if (result.status === 200) {
                        setTimeout(function () {
                            window.location.href = "{{ route('home-admin') }}";
                        }, 500);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Thao tác thất bại',
                            text: result.message,
                        })
                    }
                }
            });
        });

    })
</script>
</body>
</html>
