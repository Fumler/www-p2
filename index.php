<?php
    session_start();

    require_once('functions/connect.php');

    function hideLinks() {
        if (!empty($_SESSION['uid']))
            $hideLinks = 0;
        else
            $hideLinks = 1;

        return $hideLinks;
    }
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
    <link href="https://raw.github.com/jhollingworth/bootstrap-wysihtml5/master/src/bootstrap-wysihtml5.css" rel="stylesheet">

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
    <script src="js/jquery.dropkick-1.0.0.js"></script>
    <script src="js/jquery.tagsinput.js"></script>
    <script src="js/bootstrap-tooltip.js"></script>
    <script src="js/ajaxGet.js"></script>
    <script>
        $(document).ready (function () {
            //var div = document.getElementById('content');
            ajaxGet("pages/home.php", "content");

        });

    </script>
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
                        $("a[href='#pages']").hide();
                        $("a[href='#create']").hide();

                        ajaxGet('functions/login.php', 'login');
                        ajaxGet("pages/home.php", "content");
                    }
                }
            });
        }
    </script>
    <script type="text/javascript">
    var editMode = false;
    $(document).ready(function()
    {
        // hides/shows links
        var hideLinks = <?php echo hideLinks();?>;
        if (hideLinks) {
            $("a[href='#pages']").hide();
            $("a[href='#create']").hide();
        }
        else {
            $("a[href='#pages']").show();
            $("a[href='#create']").show();
        }

        $("a[rel]").click(function(e) {
            contentUrl = $(this).attr('rel');
            pageUrl = $(this).attr('href');
            console.log("Rel: " + contentUrl);

            $.ajax({
               url: contentUrl, success: function(data) {
                $('#content').load(contentUrl);
               }
            });

            if (contentUrl != window.location) {
                window.history.pushState({path: contentUrl + "?rel"}, '', pageUrl);
            }



            return false;
        });
        $(window).bind('popstate', function() {
                $.ajax({
                    url: location.pathname + "?rel", success: function(data) {
                        $('#content').load(contentUrl);
                    }
                });
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
                        <li><a href="#home" rel="pages/home.php">Home</a></li>
                        <li><a href="#about" rel="pages/about.php">About</a></li>
                        <li><a href="#contact" rel="pages/contact.php">Contact</a></li>
                        <li><a href="#pages" rel="pages/pageListing.php">My Pages</a></li>
                        <li><a href="#create" rel="pages/pageCreator.php">Create new page</a></li>
                    </ul>

                    <ul class="nav pull-right">
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

    <div class="row">
        <div class="span9">
            <div id="edit_menu" class="span9"></div>
        </div>
    </div>
    <div class="row">
        <div class="span9">
            <div id="content" class="span9"></div>
        </div>
    </div>



</body>
</html>
