<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Registration Page</title>
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

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <img src="{{url('')}}/src/logo.png" alt="">
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>
                <div class="alert alert-danger" style="display:none"></div>
                <form id="userForm" name="userForm" go="{{url('/api/user/user-registration')}}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" required placeholder="user name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Mobile Number" required
                            name="mobile_number">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-mobile"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">

                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" id="btn-save" class="btn btn-primary btn-block">Sign Up</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


                <a href="login.html" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{url('')}}/src/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('')}}/src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->

    <script>
        $("#userForm").on('submit', function (event) {

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
                    storeTokenSession(res.data.token);
                    },
                    error: function (data) {
                        $('.alert-danger').show();
                        $('.alert-danger').html('<p>'+data.responseJSON.api_message.message+'</p>');
                    }
                });

    })
    function storeTokenSession(token){
    $.ajax({
                type: "get",
                url: "{{url('')}}/setSession?token="+token,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: null,
                cache: false,
                contentType: false,
                processData: false,
                success: function (res) {
                    window.location.assign("{{url('/')}}/verification");
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
