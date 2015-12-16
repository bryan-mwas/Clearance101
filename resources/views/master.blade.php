<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">

    <link rel="stylesheet" href="../jquery-ui-1.11.4.custom/jquery-ui.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="../jquery-ui-1.11.4.custom/jquery-ui.theme.min.css" media="screen" title="no title" charset="utf-8">

    <style>th{background-color:#FF9900;}</style>
    <title>@yield('title')</title>
</head>
<body>
<div class="container">
    @if(Session::has('flash_msg'))
        <div id="flash_overlay" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Good Job</h4>
                    </div>
                    <div class="modal-body">
                        <p>{{ Session::get('flash_msg') }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    @endif
    @yield('content')
</div>

@yield('footer')
{{--This is to improve the loading speed of the webpage.--}}
<script type="text/javascript">
    $(function() {
        $( "#Accordion1" ).accordion({
            heightStyle: "content"
        });
        $( "#Accordion1" ).accordion({
            collapsible:true
        });
    });
    $('#flash_overlay').modal();
    $('div.alert').delay(3000).slideUp(300);
</script>
</body>
</html>