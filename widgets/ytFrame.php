<div id="ytFrameDiv" style="border-style: solid; display: inline-block;">
    <a href="#ytEditModal" role="button" data-toggle="modal" style="float: left;"><i class="icon-edit"></i></a>
    <a href="#ytDeleteModal" role="button" data-toggle="modal" style="float: right;"><i class="icon-trash"></i></a><br />
    <iframe id="ytFrameID" class="youtube-player" type="text/html" src="http://www.youtube.com/embed/4a-apSofamw" width="640" height="385" allowfullscreen frameborder="0" />
</div>

<!-- The edit modal -->
<div id="ytEditModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ytEditModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="ytEditModalLabel">Edit frame</h3>
    </div>
    <div class="modal-body">
        <form id="editForm">
            <label>Youtube ID (http://www.youtube.com/watch?v=<b>ID</b>)</label>
            <input id="contentInput" type="text" placeholder="YouTube ID" autofocus>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" data-dismiss="modal" onclick="saveContent();">Save Changes</button>
    </div>
</div>

<!-- The delete modal -->
<div id="ytDeleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ytDeleteModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="ytDeleteModalLabel">Delete?</h3>
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

        document.getElementById('ytFrameID').src = "http://www.youtube.com/embed/" + input;
    }

    // Deletes the div and it's contents
    function deleteDiv() {
        var div = document.getElementById('ytFrameDiv');
        div.parentNode.removeChild(div);
    }

</script>