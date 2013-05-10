<?php
    global $currentPage;
    $currentPage = -1;
    session_start();

    function printUser() {
        if (!empty($_SESSION['uid']))
            $userID = $_SESSION['uid'];
        else
            $userID = -1;

        return $userID;
    }
?>

<!DOCTYPE html>
    <div class="container-fluid">
        <div class="span9">
            <legend>Public pages</legend>
        </div>
            <div class="span9">
                <div id="row1" class="row-fluid">

                </div><!--/row-->
                <div id="row2" class="row-fluid">

                </div><!--/row-->
                <div id="row3" class="row-fluid">

                </div><!--/row-->
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/.fluid-container-->




<script type="text/javascript">  
    var row = 1;
    var pub = 1;

    $(document).ready(function()
    {
        $("#edit_menu").html('');
        pages.currentPage = -1;
        console.log("home.php -> currentPage: " + pages.currentPage);

        if (pages.currentUser)
        var userID = <?php echo printUser();?>;
        pages.currentUser = userID;

        pages.pageSelected = pageSelected;

        $.ajax ({
            url: 'functions/fetchPages.php',
            data: {'privacy': pub},
            type: 'post',
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    $("#row" + row).append('<div class="span4">'
                                                + '<h2>' + data[i].name + '</h2>'
                                                + '<p><a class="btn" href="javascript:pages.openPage(' 
                                                + data[i].id
                                                + ');">View Page &raquo;</a></p>'
                                            + '</div>');

                    if ((i+1)%3 == 0){
                        if (row == 3)
                            i = data.length;
                        else
                            row ++;
                    }
                }
            }
        });

        function pageSelected (id)
        {
            console.log("Page selected: " + id);
            pages.currentPage = id;
        }

    });

</script>