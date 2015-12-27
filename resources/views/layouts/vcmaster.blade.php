<!DOCTYPE HTML>
<html>
<head>
	<title>Clearance Report</title>
      <meta charset="UTF-8">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="description" content="Strathmore University Graduation clearance web interface">
      <meta name="author" content="Angela Namikoye, Brian Mwathi, Brian Phiri">
      
      <link rel="stylesheet" href="css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
      <link rel="stylesheet" href="css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">

      <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
      <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
</head>
<body style="background-color: #F2F2F2;">
  <!-- start nav -->
<div id="clearanceNavbar-bootstrap-menu" class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header"><a class="navbar-brand" href="#">Strathmore Univeristy Online Clearance</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="www.strathmore.edu">Strathmore Website</a>
                </li>
                <li><a href="www.strathmore.edu">Strathmore AMS</a>
                </li>
                <li><a href="/auth/logout">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</div>
  <!-- end nav -->
      @yield('content');
	  
<footer style="background-color: #E6E6FA;" class="footer navbar-fixed-bottom">
          <div class="footer-foot">
                <div class="container-fluid">
                      <h5 style="float: left;">Copyright © 15-12-17 - <a href="http://www.strathmore.edu/en/">Strathmore University</a>. All Rights Reserved.</h5><h5 style="color: #B0C4DE; float:right;">DAA-03-01-09/12<!--5--></h5> 
                </div>
          </div>
      </footer>
</body>
</html>