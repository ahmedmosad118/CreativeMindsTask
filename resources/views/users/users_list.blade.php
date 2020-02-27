<!DOCTYPE html>

<html lang="en">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="http://localhost/CreativeMinds/public/src/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="http://localhost/CreativeMinds/public/src/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet"
        href="http://localhost/CreativeMinds/public/src/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="http://localhost/CreativeMinds/public/src/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="http://localhost/CreativeMinds/public/src/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="http://localhost/CreativeMinds/public/src/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="http://localhost/CreativeMinds/public/src/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="http://localhost/CreativeMinds/public/src/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>

<body>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">




                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Messages Dropdown Menu -->

                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                            <i class="fas fa-th-large"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.navbar -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="index3.html" class="brand-link">
                    <img src="http://localhost/CreativeMinds/public/src/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">AdminLTE 3</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img src="http://localhost/CreativeMinds/public/src/dist/img/user2-160x160.jpg"
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->



                            <li class="nav-header">Pepole</li>
                            <li class="nav-item">
                                <a href="http://localhost/CreativeMinds/public/users/users-list" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Users</p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="container">
                    <br>
                    <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-user">Add New</a>
                    <br><br>

                    <table class="table table-bordered table-striped" id="laravel_datatable">
                        <thead>
                            <tr>
                                <th>No </th>
                                <th>Name</th>
                                <th>mobile_number</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="modal fade" id="modal-add" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="userModel"> Add User</h4>
                            </div>
                            <div class="alert alert-danger" style="display:none"></div>
                            <div class="modal-body">
                                <form id="userForm" name="userForm" go="{{url('/api/user/user-registration')}}"
                                    class="form-horizontal">
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label">User Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Enter User Name" value="" maxlength="100" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name" class="col-sm-4 control-label">Mobile Number</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="mobilenumber" name="mobile_number" placeholder="Enter Mobile Number" value=""
                                                maxlength="50" required="">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">Password</label>
                                        <div class="col-sm-12">
                                            <input type="password" class="form-control" id="password" name="password"
                                                placeholder="Enter Password" value="" required="">
                                        </div>
                                    </div>
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modal-edit" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"> Edit User</h4>
                                            </div>
                                            <div class="alert alert-danger" style="display:none"></div>
                                            <div class="modal-body">
                                                <form id="userForm" name="userFormEdit" go="{{url('/api/user/edit-user')}}" class="form-horizontal">
                                                    <div class="form-group">
                                                        <input type="text" name="user_id" id="user_id" style="display:none">
                                                        <label for="name" class="col-sm-4 control-label">User Name</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="username" name="username"
                                                                placeholder="Enter User Name" value="" maxlength="100" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-4 control-label">Mobile Number</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="mobile_number" name="mobile_number"
                                                                placeholder="Enter Mobile Number" value="" maxlength="50" required="">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-4 control-label">Password</label>
                                                        <div class="col-sm-12">
                                                            <input type="password" class="form-control" id="password" name="password"
                                                                placeholder="Enter Password" value="" required="">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                <!-- /.content-header -->

                <!-- Main content -->

            </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version</b> 3.0.2
                </div>
            </footer>
        </div>


        <script>
            $(document).ready( function () {
       $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': "bearer {{session()->get('token')}}",


          }
      });
      $('#laravel_datatable').DataTable({
processing: true,
        serverSide: true,
        ajax: '{{ url("api/user/index") }}',

        columns: [
        { data: 'id', name: 'id' },
        { data: 'username', name: 'username' },
        { data: 'mobile_number', name: 'mobile_number' },
        {data: 'action', name: 'action', orderable: false, searchable: false},
        ] });

     /*  When user click add user button */
        $('#create-new-user').click(function () {
            $('#btn-save').val("create-product");
            $('$user_id').val('');
            $('#userForm').trigger("reset");
            $('#userModel').html("Add New Product");
            $('#modal-add').modal('show');
        });

       /* When click edit user */
        $('body').on('click', '.edit-user', function () {
          var user_id = $(this).data('id');
          $.get('{{url('')}}/api/user/user-info/' + user_id, function (response) {
            if(response.api_status){
             var data = response.data;
             $('#title-error').hide();
             $('#product_code-error').hide();
             $('#description-error').hide();
              $('#modal-edit').modal('show');
              $('#user_id').val(data.id);
              $('#username').val(data.username);
              $('#mobilenumber').val(data.mobile_number);
              console.log(data.mobile_number);
                }
          })
       });

        $('body').on('click', '#delete-user', function () {

            var user_id = $(this).data("id");
            if(confirm("Are You sure want to delete !")){
              $.ajax({
                  type: "get",
                  url:"{{url('')}}/api/user/delete-user/"+user_id,
                  success: function (data) {
                  var oTable = $('#laravel_datatable').dataTable();
                  oTable.fnDraw(false);
                  },
                  error: function (response) {
                      $('#msg').load(getBaseUrl() + "/message");
                      console.log('Error:', response.responseJSON.errors);
                  }
              });
            }
        });

       });

    if ($("#userForm").length > 0) {
          $("#userForm").validate({
         submitHandler: function(form) {
          var actionType = $('#btn-save').val();
          $('#btn-save').html('Sending..');
         var action = $(this).attr('go');

          $.ajax({
              data: $('#userForm').serialize(),
              headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Authorization': "bearer {{session()->get('token')}}",
                            },
              url: action,
              type: "POST",
              dataType: 'json',
              success: function (data) {
                    $('#userForm').trigger("reset");
                    $('#modal-add').modal('hide');
                    $('#btn-save').html('Save Changes');
                    var oTable = $('#laravel_datatable').dataTable();
                    oTable.fnDraw(false);

              },
                  error: function (data) {
                      var response = JSON.parse(data.error().responseText);
                      handleError(response.api_message.message);
            }
          });
        }
      })
    }

    function handleError(errors) {
        $.each(response.api_message.message, function(key, value){
        $('.alert-danger').show();
        $('.alert-danger').append('<p>'+value+'</p>');
        });
    }
        </script>
    </body>

</html>
