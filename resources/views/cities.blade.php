@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-lg-6 col-lg-offset-3">

            <form method="POST" id="form">

                <!-- Add new city form -->
                <div class="row form-group">
                    <div class="input-group">
                        <input type="text" name="name" id="name" class="form-control" placeholder="City">
                        <button type="submit" class="input-group-addon success" id="ajaxSubmit"><span class="glyphicon glyphicon-ok"></span></button>
                    </div>
                </div>

                {{ csrf_field() }}
            </form>
            <div class="alert alert-success" style="display:none"></div>
        </div>

    </div>

    @include('data')

    <script>
        jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                jQuery.ajax({
                    url: "{{ url('/city') }}",
                    method: 'post',
                    data: {
                        name: jQuery('#name').val(),
                    },
                    success: function(result){
                        jQuery('.alert').show();
                        jQuery('.alert').html(result.success);
                        refreshData();
                        $("#form")[0].reset();
                    }});
            });
        });

        function refreshData() {
            $('div.data').fadeOut();
            $('div.data').load("{{ url('/data') }}", function() {
                $('div.data').fadeIn();
            });
        }
    </script>

@endsection