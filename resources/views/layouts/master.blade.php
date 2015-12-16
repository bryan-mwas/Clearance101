<!DOCTYPE HTML>
<html>
<head>
	<title>Clearance Form</title>
      <meta charset="UTF-8">
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
        <footer class="footer navbar-fixed-bottom" style="background-color: #E6E6FA; height: 70px;">
            <div class="footer-main">
               <div class="container-fluid">
                   <div class="row-fluid">
                      <div class="span4">
                          <div  class="infoarea">
                            <div  class="footer-logo">
                              <a  href="https://strathmore.edu">
                                  <img  src="//elearning.strathmore.edu/pluginfile.php?file=%2F1%2Ftheme_klass%2Ffooterlogo%2F1446031855%2FPicture16.png" alt="strathmore logo" height="80" width="183">
                              </a>
                            </div>
                              <p>Strathmore university online graduation clearance form</p>
                          </div>
                      </div>
                         <div class="span2" style="float:right;">
                             <p style="color: #B0C4DE;">DAA-03-01-09/12</p>
                         </div>
                         <div class="span3"></div>
                   </div>
                </div>
            </div>
          <div class="footer-foot">
                <div class="container-fluid">
                      <p>Copyright © {{ date('y-m-d') }} - <a href="http://www.strathmore.edu/en/">Strathmore University</a>. All Rights Reserved.</p>
                </div>
          </div>
      </footer>
</body>
</html>