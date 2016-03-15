<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Strathmore Clearance</title>

    <script type="text/javascript" src="{{asset('/js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('/js/bootstrap.min.js')}}"></script>

    <link rel="stylesheet" href="../css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css" media="screen" title="no title" charset="utf-8">


    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">
  </head>

  <body style="background-color: #F2F2F2;">

    <nav class="navbar navbar-fixed-top">
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
                      <li><a href="/logout">Logout</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <!-- end nav -->
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Overview <span class="sr-only">(current)</span></a></li>
            <li><a href="#">Staff Authorization</a></li>
            <li><a href="#">Student Reports</a></li>
            <li><a href="#">Clearance Reports</a></li>
            <li><a href="#">Financial Reports</a></li>
            <li><a href="#">Export</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Dashboard</h1>
          <!--  -->

          <!--  -->
        </div>
      </div>
    </div>

    <!-- footer -->
    <footer style="background-color: #E6E6FA;" class="footer navbar-fixed-bottom">
                <div class="footer-main">
                   <div class="container-fluid">
                       <div class="row-fluid">
                          <div class="span2">
                              <div class="infoarea">
                                <div class="footer-logo">
                                  <p style="color: #B0C4DE; float: right;">DAA-03-01-09/12</p>
                                  </div>
                              </div>
                          </div>
                       </div>
                    </div>
                </div>
    						<div class="footer-foot">
    	                <div class="container-fluid">
    	                      <center><p>Copyright © {!! date('Y-m-d') !!} - <a href="http://www.strathmore.edu/en/">Strathmore University</a>. All Rights Reserved.</p></center>
    	                </div>
    	          </div>
          </footer>
    <!-- end footer -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 </body>
</html>
