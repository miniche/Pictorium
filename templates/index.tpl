<!DOCTYPE html>
<html>
    <head>
        <title>{PAGE_TITLE}</title>

        <meta charset="UTF-8" />

        <!-- iOS WebApp enable -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="apple-mobile-web-app-status-bar-style" content="black" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" media="screen" href="templates/css/bootstrap.css">
        <!--<link rel="stylesheet" media="screen" href="templates/css/bootstrap-responsive.css">-->
        <link rel="stylesheet" media="screen" href="templates/css/style.css">

        <script src="templates/js/jquery.js"></script>
        <!-- Pictorium Javascript functions -->
        <script src="templates/js/functions.js"></script>

    </head>
    <body onload="onLoadDocument();" onresize="onResizeDocument();">

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">

                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>

                    <a class="brand" href="index.php">{APPLICATION_NAME}</a>
                    
                    <div class="nav-collapse">
                        <ul class="nav">
                        </ul>
                    </div>
                </div>

            </div>

        </div>
        <div class="picto_container">
            <div id="left_menu" class="menu">
                
            </div>
            
            <div id="right_album">
                
            </div>
        </div>

    </body>

    <!-- Bootstrap JS -->
    <script src="templates/js/bootstrap.js"></script>

</html>