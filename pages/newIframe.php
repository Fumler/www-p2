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

    // Saves the input-content to the iframe 'src' attribute
    function saveContent() {
        var input = $('#contentInput').val();

        document.getElementById('iframeID').src = "http://www.youtube.com/embed/" + input;
    }

    function deleteDiv() {
        var div = document.getElementById('iframeDiv');
        div.parentNode.removeChild(div);
    }

</script>