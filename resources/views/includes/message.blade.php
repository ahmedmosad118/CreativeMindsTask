@if(count($errors->all()))
<div class='alert alert-dismissable alert-danger'>
    <button type="button" class="close" onclick="this.parentElement.style.display = 'none';"
        aria-hidden="true"></button>
    @foreach($errors->all() as $error)
    {{ $error }}<br />
    @endforeach
</div>
@endif

@if(session('importerrors') )
<?php $importerrors = session('importerrors');   ?>
<div class='alert alert-dismissable alert-danger'>
    <button type="button" class="close" onclick="this.parentElement.style.display = 'none';"
        aria-hidden="true"></button>
    @foreach($importerrors as $error)
    {{ $error }}<br />
    @endforeach
</div>
@endif

@if(session('success_message'))

<div class="m-alert m-alert--icon alert alert-primary " role="alert">
    <div class="m-alert__icon">
        <i class="flaticon-danger"></i>
    </div>
    <div class="m-alert__text">
        <strong>

        </strong>
        {{ session('success_message') }} .
    </div>
    <div class="m-alert__close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<script type="text/javascript">
    setTimeout(function() {

toastr.info("{{ session('success_message') }} !");

            }, 100);

 toastr.options = {

  "positionClass": "toast-top-right",

  "showDuration": "1000",

};
</script>
@endif

@if(session('error_message'))

<div class="m-alert m-alert--icon alert alert-danger" role="alert">
    <div class="m-alert__icon">
        <i class="flaticon-danger"></i>
    </div>
    <div class="m-alert__text">
        <strong>

        </strong>
        {{ session('error_message') }} .
    </div>
    <div class="m-alert__close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('delete_message'))


<div class="alert  alert-info alert-dismissible fade show  ">

    {{ session('delete_message') }} .

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
</div>

@endif
@if(session('error-danger'))


<div class="m-alert m-alert--icon alert alert-danger" role="alert">
    <div class="m-alert__icon">
        <i class="flaticon-danger"></i>
    </div>
    <div class="m-alert__text">
        <strong>

        </strong>
        {{ session('error_message') }} .
    </div>
    <div class="m-alert__close">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

@endif


<!-- divs for ajax -->

<div style="display: none;" class="alert alert-danger errors">
    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="padding-top:10px;"></button> -->
    <ul></ul>
</div>


<div style="display: none;" class="alert alert-warning alert-dismissible fade show ">
    @if(session('delete_message'))

    {{ session('delete_message') }} .

    @endif

    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
</div>
