<?php
    global $currentPage;
    $currentPage = -1;
?>

<script type="text/javascript">

    $(document).ready(function()
    {
        pages.currentPage = -1;
        console.log("home.php -> currentPage: " + pages.currentPage);
    });

</script>

    <div class="container-fluid">
            <div class="span9">
                <div class="row-fluid">
                    <div class="span4">
                        <h2>Test2</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                    </div><!--/span-->
                    <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                    </div><!--/span-->
                    <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                    </div><!--/span-->
                    </div><!--/row-->
                    <div class="row-fluid">
                    <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                    </div><!--/span-->
                    <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                    </div><!--/span-->
                    <div class="span4">
                        <h2>Heading</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn" href="#">View details &raquo;</a></p>
                    </div><!--/span-->
              </div><!--/row-->
            </div><!--/span-->
        </div><!--/row-->
    </div><!--/.fluid-container-->

    <div id="iframeDiv" style="border-style: solid; display: inline-block;">
        <a href="#editModal" role="button" data-toggle="modal" style="float: left;"><i class="icon-edit"></i></a>
        <a href="#deleteModal" role="button" data-toggle="modal" style="float: right;"><i class="icon-trash"></i></a><br />
        <iframe id="iframeID" class="youtube-player" type="text/html" src="http://www.youtube.com/embed/4a-apSofamw" width="640" height="385" allowfullscreen />
    </div>

    <!-- The edit modal -->
    <div id="editModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="editModalLabel">Edit frame</h3>
        </div>
        <div class="modal-body">
            <form id="editForm">
                <label>Youtube ID (http://www.youtube.com/watch?v=<b>ID</b>)</label>
                <input id="contentInput" type="text" placeholder="YouTube ID" autofocus>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" data-dismiss="modal" onclick="saveContent();">Save shit</button>
        </div>
    </div>

    <!-- The delete modal -->
    <div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h3 id="deleteModalLael">Delete?</h3>
        </div>
        <div class="modal-body">
            <p>Really delete?</p>
        </div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            <button class="btn btn-danger" data-dismiss="modal" onclick="deleteDiv();">Delete</button>
        </div>
    </div>

<script type="text/javascript">

    function saveContent() {
        var input = $('#contentInput').val();

        document.getElementById('iframeID').src = "http://www.youtube.com/embed/" + input;
    }

    function deleteDiv() {
        var div = document.getElementById('iframeDiv');
        div.parentNode.removeChild(div);
    }

</script>