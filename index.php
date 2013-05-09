<?php
session_start();

    require_once('functions/connect.php');

    // // Register new user
    // if (isset($_POST['regUser']) && isset($_POST['regPwd']) && isset($_POST['regConfirmPwd'])) {
    //     if ($_POST['regPwd'] == $_POST['regConfirmPwd']) {
    //         $user->newUser($_POST['regUser'], $_POST['regPwd']);
    //     }
    //     else {
    //         $user->error = "<strong>Error:</strong> The passwords don't match";
    //     }
    // }

    // $_SESSION[ 'uid' ] = 1;
?>

<!DOCTYPE html>
<html lang="en">
<script src="js/widget.js"></script>
<script src="js/pages.js"></script>
<head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
        body { padding-top: 60px; padding-bottom: 40px; }
    </style>
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <!-- <link href="css/flat-ui.css" rel="stylesheet"> -->
    <link href="css/custom.css" rel="stylesheet">

    <style type="text/css" id="styles">
        @import "css/flat-ui.css";
    </style>


    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/images/apple-touch-icon-114x114.png">
</head>
<body>

    <!-- javascript
    ================================================== -->
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/application.js"></script>
    <script src="js/jquery-ui-1.10.0.custom.min.js"></script>
    <script src="js/jquery.dropkick-1.0.0.js"></script>
    <script src="js/custom_checkbox_and_radio.js"></script>
    <script src="js/custom_radio.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/dropdown.js"></script>
    <script src="js/jquery.placeholder.js"></script>
    <script src="js/ajaxGet.js"></script>
    <script src="js/jquery.address-1.5.js"></script>

    <script type="text/javascript">
    $(document).ready(function()
    {

        function loadURL(url) {
            console.log("loadURL: " + url);
            $("#content").load(url);
        }
        $.address.init(function(event) {
            console.log("init: " + $('[rel="address:' + event.value + '"]').attr('href'));
            $.address.strict(false);
        }).change(function(event) {
            $("#content").load($('[rel="address:' + event.value + '"]').attr('href'));
            $("li").removeClass("active");
            $('a[href="'+$('[rel="address:' + event.value + '"]').attr('href')+'"]').parent().addClass('active');
            $.address.title(event.value.toUpperCase() + " - Fronter 2.0");
            console.log("change");
        });
        $.address.title("Fronter 2.0");

        $('a').click(function(){
            loadURL($(this).attr('href'));
        });

        });
    </script>
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <a class="brand" href="#">Fronter 2.0</a>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li><a href="pages/home.php" rel="address:home">Home</a></li>
                        <li><a href="pages/about.php" rel="address:about">About</a></li>
                        <li><a href="pages/contact.php" rel="address:contact">Contact</a></li>
                        <li><a href="pages/pageListing.php" rel="address:pagelist">My Pages</a></li>
                        <li><a href="pages/pageCreator.php" rel="address:newpage">Create new page</a></li>
                    </ul>

                    <ul class="nav pull-right">
                        <div id="settings">
                        </div>
                        <div id="login">
                            <?php
                            if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
                                include("functions/loggedIn.php");
                            } else {
                                include("functions/login.php");
                            }?>
                        </div>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>

    </div>
    <div id="edit_menu"></div>
    <div id="content" class="span9" >

        <script>
        $(document).ready (function () {
            //var div = document.getElementById('content');
            ajaxGet("pages/home.php", "content");
        });

        </script>
    </div>

    <script type="text/javascript">
        function fixModal(classId) {
            $("."+classId +" .modal").appendTo($("body"));
        }

        function logout(){
            $.ajax({
            type: "GET",
            url: 'functions/logout.php',
            async: true,
            success: function (response)
                {
                    // console.log(response);
                    //return response;
                    if(response == "logged out")
                    {
                        ajaxGet('functions/login.php', 'login');
                        ajaxGet("pages/home.php", "content");
                    }
                }
            });
        }
    </script>

</body>
</html>
