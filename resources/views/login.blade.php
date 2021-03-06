<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CreativeMind | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('')}}/src/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{url('')}}/src/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('')}}/src/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <img src="{{url('')}}/src/logo.png" alt="">
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session </p>
                <div class="alert alert-danger" style="display:none"></div>
                <form go="{{url('')}}/api/user/login" id="user_login">
                    {{csrf_field()}}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Mobile Number" name="mobile_number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fas fa-mobile"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <button type="submit" id="btn-save" class="btn btn-primary btn-block">Sign In</button>
                    </div>

                    <!-- /.col -->
            </div>

            </form>


            <div class="col-8" style="margin:3px;">
                <a href="{{url('')}}/register" class="text-center" style="text-align:center">Register a new
                    membership</a>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{url('')}}/src/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('')}}/src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script>
        $("#user_login").on('submit', function (event) {

            event.preventDefault();
            $('.alert-danger').hide();
            var form = $(this);
            var data = new FormData(this);
            var action = form.attr('go')
            $.ajax({
                type: "POST",
                url: action,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    storeTokenSession(res.data.token,"dashboard");
                },
                error: function (res) {
                $('.alert-danger').show();
                $('.alert-danger').html('<p>'+res.responseJSON.api_message.message+'</p>');
                if(res.responseJSON.api_message.message == "Your account is not verified"){
                    storeTokenSession(res.responseJSON.data.token , "verification");
                }
                }
             });

   })
function storeTokenSession(token, perfix){
    $.ajax({
            type: "get",
            url: "{{url('')}}/setSession?token="+token,
            headers: {
                'Authorization': "bearer {{session()->get('token')}}",
            },
            data: null,
            cache: false,
            contentType: false,
            processData: false,
                success: function (res) {
                    window.location.assign("{{url('/')}}/"+perfix);
                },

            error: function (data) {
                $('.alert-danger').show();
                $('.alert-danger').append('<p>'+data.responseJSON.api_message.message+'</p>');
            }
            });
}

    </script>

</body>

</html>
