<?php
	session_start();
?>

<h1> Page Creator ni irasshaimase! </h1>

<form id="creationform" method="post">
	Enter the name for the new webpage: <input type="text" name="name" id="name" value="">
	<input type="submit" name="creationsub" id="creationsub" value="create">

</form>

<script type="text/javascript" language="javascript">

	$(document).ready(function() 
	{
		console.log("pageCreator.php -> currentPage: " + pages.currentPage);
		$('#creationform').submit(function(e)
		{
			e.preventDefault(); // avoid page refresh.
			
			var name = $('#name').val();

			console.log(name);
			console.log(pages.currentPage);
			pages.createNewPage(name, pages.currentPage);
		});
	});

</script>