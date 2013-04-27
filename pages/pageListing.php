<?php
	session_start();
?>

<script type="text/javascript">

	$(document).ready(function()
	{
	    pages.currentPage = -1;
	    console.log("pageListing.php -> currentPage: " + pages.currentPage);
	});
</script>

<!DOCTYPE html>
<html>
<head>
	<title>Page Listing</title>
</head>
<h1>Page Listing</h1>

<div id="pages">
</div>

<script type="text/javascript">

	$(document).ready (function () 
	{
		var userID = <?php echo $_SESSION[ 'uid' ]?>;
		pages.currentUser = userID;
		console.log("pages.currentUser = " + pages.currentUser);

		pages.init();
		pages.pageSelected = pageSelected;
	});

	function pageSelected (id) 
	{
		console.log("Page selected: " + id);
		pages.currentPage = id;
	}

</script>
</html>