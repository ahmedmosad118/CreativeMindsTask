<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Forgot Password</title>
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
                <p class="login-box-msg"> Activate Your account</p>
                <div class="alert alert-danger" style="display:none"></div>
                <form go="{{url('')}}/api/user/verify-account" id="userVerify">
                    <div class="input-group mb-3">
                        <input type="text" name="id" id="userId" value="{{$id}}" style="display:none">
                        <input type="text" class="form-control" name="verification_code" required
                            placeholder="enter recived code">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-sms"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" id="btn-save" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <p class="mb-0">
                    <a href="{{url("/logout")}}" class="text-center">Login with anther account</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{url('')}}/src/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('')}}/src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('')}}/src/dist/js/adminlte.min.js"></script>

    <script>
        $("#userVerify").on('submit', function (event) {

                        event.preventDefault();
                        $('.alert-danger').hide();
                        var form = $(this);
                        var data = new FormData(this);
                        var action = form.attr('go');
                        $.ajax({
                            type: "POST",
                            url: action,
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (res) {
                                window.location.assign("{{url('/')}}/dashboard");
                            },
                            error: function (data) {
                                $('.alert-danger').show();
                                $('.alert-danger').html('<p>'+data.responseJSON.api_message.message+'</p>');
                            }
                        });

            })

    </script>

</body>

</html>
