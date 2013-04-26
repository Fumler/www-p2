<?php
	session_start();

	global $currentPage;
	$currentPage = -1;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Page Listing</title>
</head>
<h1>Page Listing</h1>

<div id="pages">
</div>

<script src="js/pages.js"></script>
<script type="text/javascript">

	console.log("How about now?!");

	$(document).ready (function () 
	{
		<!-- 
		<?php
			echo "var userID = " . $_SESSION[ 'uid' ];
		?>
		// -->

		console.log("Hei " + userID);
		pages.pageSelected = pageSelected;
		pages.init ();
	});

	function pageSelected (id) 
	{
		console.log("Page selected: " + id);
	}

</script>
</html>

<!-- 	// $(document).ready (function () 
	// {
	// 	$.ajax({
	// 		url: 'functions/fetchPages.php',
	// 		data: {'id': -1},
	// 		type: 'post',
	// 		success: function( data )
	// 		{
	// 			$('#pages').html('<ul class="pages"></ul>');

	// 	        for(var i = 0; i < data.length; i++)
	// 	        {
	// 	            $('#pages .pages').append
	// 	            (

	// 	            	'<li id="page_' + data[i].uid + '_' + data[i].id + '">' + 
	// 	                '<span class="pageicon">&nbsp;</span>' + 
	// 	                '<a href="javascript:openClose(' + data[i].id + ');">' + 
	// 	                data[i].name + '</a></li>'
	// 	            );

	// 	            $('#pages .pages').last().loaded = false;
	// 	        }
	// 		}
	// 	});
	// });

	// function openClose( id ) 
	// {
	//     if( $('#page_1_' + id)[0].loaded )
	//     {
	//         $('#page_1_' + id + ' ul').toggle();
	//     }
	//     else
	//     {
	//         $('#page_1_' + id)[0].loaded = true;
	//         $('#page_1_' + id).append('<ul class="pages"></ul>');

	//         $.ajax ({
	//             url: 'functions/fetchPages.php',
	//             data: {'id': id},
	//             type: 'post',
	//             success: function (data) 
	//             {
	//                 for (var i = 0; i < data.length; i++) 
	//                 {
	//                     $('#page_1_' + id + ' ul').append
	//                     (
	// 	                    '<li id="page_' + data[i].uid + '_' + data[i].id + '">' + 
	// 	                    '<span class="pageicon">&nbsp;</span>' + 
	// 	                    '<a href="javascript:openClose(' + data[i].id + ');">' +
	// 	                    data[i].name + '</a></li>'
	//                     );

	//                     $('#page_1_' + id + ' ul li').last().loaded = false;
	//                 }
	//             }
	//         }); // ajax end
	//     }
	// } -->