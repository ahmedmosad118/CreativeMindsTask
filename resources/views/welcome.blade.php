@extends('name')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<div class="container">
        <h2>Laravel DataTable Ajax Crud Tutorial - Ahmed </h2>
        <br>
        <a href="https://www.tutsmake.com/how-to-install-yajra-datatables-in-laravel/" class="btn btn-secondary">Back to
            Post</a>
        <a href="javascript:void(0)" class="btn btn-info ml-3" id="create-new-product">Add New</a>
        <br><br>

        <table class="table table-bordered table-striped" id="laravel_datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>mobile_number</th>
                    <th>action</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="ajax-product-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="userModel"></h4>
                </div>
                <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-body">
                    <form id="userForm" name="userForm" go="{{url('/api/user/user-registration')}}" class="form-horizontal">
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
            { data: 'mobile_number', name: 'email' },
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ] });

         /*  When user click add user button */
            $('#create-new-product').click(function () {
                $('#btn-save').val("create-product");
                $('#product_id').val('');
                $('#userForm').trigger("reset");
                $('#userModel').html("Add New Product");
                $('#ajax-product-modal').modal('show');
            });

           /* When click edit user */
            $('body').on('click', '.edit-product', function () {
              var user_id = $(this).data('id');
              console.log(user_id);
              $.get('{{url('')}}/api/user/user-info/' + user_id, function (response) {
                if(response.api_status){
                 var data = response.data;
                 $('#title-error').hide();
                 $('#product_code-error').hide();
                 $('#description-error').hide();
                 $('#userModel').html("Edit Product");
                  $('#btn-save').val("edit-product");
                  $('#ajax-product-modal').modal('show');
                  $('#product_id').val(data.id);
                  $('#username').val(data.username);
                  $('#mobile_number').val(data.mobile_number);
                  $('#description').val(data.description);

                    }
              })
           });

            $('body').on('click', '#delete-product', function () {

                var product_id = $(this).data("id");

                if(confirm("Are You sure want to delete !")){
                  $.ajax({
                      type: "get",
                      url: SITEURL + "product-list/delete/"+product_id,
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
            event.preventDefault();
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
                        $('#ajax-product-modal').modal('hide');
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
  </div>
  <!-- /.content-wrapper -->

@endsection
