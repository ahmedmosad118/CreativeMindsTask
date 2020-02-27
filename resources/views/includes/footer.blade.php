<footer class="main-footer">
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.2
    </div>
</footer>
</div>


<script src="{{url('')}}/src/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{url('')}}/src/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<!-- Bootstrap 4 -->
<script src="{{url('')}}/src/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
{{-- <script src="{{url('')}}/src/plugins/chart.js/Chart.min.js"></script> --}}
<!-- Sparkline -->
<!-- JQVMap -->
{{-- <script src="{{url('')}}/src/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{url('')}}/src/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{url('')}}/src/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{url('')}}/src/plugins/moment/moment.min.js"></script> --}}
{{-- <script src="{{url('')}}/src/plugins/daterangepicker/daterangepicker.js"></script> --}}
<!-- Tempusdominus Bootstrap 4 -->
{{-- <script src="{{url('')}}/src/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> --}}
<!-- Summernote -->
{{-- <script src="{{url('')}}/src/plugins/summernote/summernote-bs4.min.js"></script> --}}
<!-- overlayScrollbars -->
{{-- <script src="{{url('')}}/src/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> --}}
<script src="{{url('')}}/src/plugins/datatables/jquery.dataTables.js"></script>

<!-- AdminLTE App -->
{{-- <script>
    $("#modal_edit , #modal_edit_full ,#edit-modal").on("show.bs.modal", function(e) {
        if(e.relatedTarget != undefined){

        $(this).find(".modal-content").html('<div style="text-align: center; padding: 25px;">\
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: left">\
                <span aria-hidden="true"> × </span>\
            </button>\
            <img style=" max-width: 54px;" src="{{ url('/') }}/src/assets/demo/modal_loading.gif" alt="" class="loading">\
            <span> {{__("Loading")}} ... </span>\
        </div>');
        }

        var link = $(e.relatedTarget);


        $(this).find(".modal-content").load(link.attr("href"));

        });
</script> --}}
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

            function handleError(errors) {
                $.each(response.api_message.message, function(key, value){
                $('.alert-danger').show();
                $('.alert-danger').append('<p>'+value+'</p>');
                });
            }
</script>

{{-- <script src="{{url('')}}/src/dist/js/adminlte.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
</body>

</html>
