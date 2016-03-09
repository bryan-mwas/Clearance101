
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Application portal</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/cover.css" rel="stylesheet">
</head>

<body>

<div class="site-wrapper">

    <div class="site-wrapper-inner">

        <div class="cover-container">

            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">Strathmore Clearance Application</h3>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li class="active"><a href="/logout">Log out</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <form class="" action="" method="post">
              <div class="inner cover">
                  <h1 class="cover-heading">Welcome to the Strathmore Clearance service {{ $student['studentNames'] }}</h1>
                  <h3 class=""><u>Apply to kick start the clearance process!</u></h3>
                  <p class="lead">Click the apply button to start the clearance process</p>

                  <p class="lead">
                      <a href="/activate" class="btn btn-lg btn-primary">Apply</a>
                  </p>
              </div>
            </form>


            <div class="mastfoot">
                <div class="inner">
                    {{--<p>Cover template for <a href="http://getbootstrap.com">Bootstrap</a>, by <a href="https://twitter.com/mdo">@mdo</a>.</p>--}}
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/jquery-ui.min.js')}}"></script>
<script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
</body>
</html>
