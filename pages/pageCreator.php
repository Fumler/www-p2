<h1> Page Creator ni irasshaimase! </h1>

<form id="creationform" method="post">
	Enter the name for the new webpage: <input type="text" name="name" id="name" value="">
	<input type="submit" name="creationsub" id="creationsub" value="Create">

</form>

<script src="js/pages.js"></script>
<script type="text/javascript">

$(document).ready(function() 
{
	$('#creationform').submit(function(e)
	{
		e.preventDefault(); // avoid page refresh.
		

		var name = $('#name').val();

		console.log(name);
		Pages.createNewFolder(name, currentPage);
	});
});

</script>