<div id="ssFrameDiv" style="border-style: solid; display: inline-block;">
    <a id="ssEditIcon" href="#ssEditModal" role="button" data-toggle="modal" style="float: left;"><i class="icon-edit"></i></a>
    <a id="ssDeleteIcon" href="#ssDeleteModal" role="button" data-toggle="modal" style="float: right;"><i class="icon-trash"></i></a><br />
    <iframe id="ssFrameID" width="640" height="480" frameborder="0" />
</div>

<div id="ssTestButtons">
	<button type="button" class="btn btn-primary" onclick="removeBorder();">Remove border</button>
	<button type="button" class="btn btn-primary" onclick="addBorder();">Add border</button>
</div>

<!-- Edit modal -->
<div id="ssEditModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ssEditModalLabel" aria-hidden="true">
	<div class ="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="ssEditModalLabel">Edit frame</h3>
	</div>
	<div class="modal-body">
        <!-- START Flickr div -->
        <div id="ss1" class="desc1">
			<form id="editForm">
				<label>User ID</label>
				<input id="fUserID" type="text" placeholder="USER_ID" >
			</form>
			<!-- More radiobuttons -->
			<div id="IDradioGroup">
				by tag  <input type="radio" name="flickr" id="fr1" checked="checked" value="1">
				by set  <input type="radio" name="flickr" id="fr2" value="2">
				<br /><br />
			</div>
			<!-- TAG_ID div -->
			<div id="flickr1" class="desc2">
				<form id="flickrForm1">
					<label>Tag ID</label>
					<input id="fTagID" type="text" placeholder="TAG_ID">
				</form>
			</div>
			<!-- SET_ID div -->
			<div id="flickr2" class="desc2" style="display: none;">
				<form id="flickrForm2">
					<label>Set ID</label>
					<input id="fSetID" type="text" placeholder="SET_ID">
				</form>
			</div>
		</div>
		<!-- END Flickr Div -->
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
		<button class="btn btn-primary" data-dismiss="modal" onclick="saveFlickr();">Save Changes</button>
	</div>
</div>

<!-- Delete modal -->
<div id="ssDeleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="ssDeleteModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="ssDeleteModalLabel">Delete?</h3>
	</div>
	<div class="modal-body">
		<p>Really delete?</p>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		<button class="btn btn-danger" data-dismiss="modal" onclick="deleteSSFrame();">Delete</button>
	</div>
</div>

<script type="text/javascript">

	// Saves the input-content to the iframe
	function saveFlickr() {
		var userID = $('#fUserID').val();

		if ($("#fr1").is(':checked')) {
			var tagID = $('#fTagID').val();

			document.getElementById('ssFrameID').src = "http://www.flickr.com/slideShow/index.gne?user_id=" + userID + "&tag_id=" + tagID;
		}
		else if ($("#fr2").is(':checked')) {
			var setID = $('#fSetID').val();

			document.getElementById('ssFrameID').src = "http://www.flickr.com/slideShow/index.gne?user_id=" + userID + "&photoset_id=" + setID;
		}

		// Resize the iframe to 500x500
		document.getElementById('ssFrameID').width = 500;
		document.getElementById('ssFrameID').height = 500;
	}

	// Deletes the div and it's contents
	function deleteSSFrame() {
		var div = document.getElementById('ssFrameDiv');
		div.parentNode.removeChild(div);

		var testDiv = document.getElementById('ssTestButtons');
		testDiv.parentNode.removeChild(testDiv);
	}

	// Removes border and buttons
	function removeBorder() {
		document.getElementById('ssFrameDiv').style.borderStyle = "none";
		$("#ssEditIcon").hide();
		$("#ssDeleteIcon").hide();
	}

	// Adds border and buttons
	function addBorder() {
		document.getElementById('ssFrameDiv').style.borderStyle = "solid";
		$("#ssEditIcon").show();
		$("#ssDeleteIcon").show();
	}

</script>
