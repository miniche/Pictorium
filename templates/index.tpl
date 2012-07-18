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

            <div id="main_right">

                <!-- Displaying album -->
                <div id="main_album">

                </div>

                <!-- Displaying one photo -->
                <div id="main_photo_id" class="display_photo" style="display:none;">

                    <div class="bar">
                        <a id="main_photo_btn_return" class="return btn btn-inverse" onclick="returnToAlbum();">< <span id="main_photo_btn_return_lib">BTN_RETURN</span></a>

                        <div id="main_photo_title" class="title">LIB_TITLE</div>

                        <a class="download btn btn-inverse"><i class=" icon-download icon-white"></i></a>

                        <div class="clear"></div>

                    </div>
                    <div class="debug">
                        <span id="photo_input_datas_width">0</span> x 
                        <span id="photo_input_datas_height">0</span>
                    </div>

                    <div class="photo">
                        <img id="main_photo_img" src="{PHOTO_PATH}" alt="{PHOTO_NAME}" />
                    </div>

                </div>


            </div>
        </div>

    </body>

    <!-- Bootstrap JS -->
    <script src="templates/js/bootstrap.js"></script>

</html>